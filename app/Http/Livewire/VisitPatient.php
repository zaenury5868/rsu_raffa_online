<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class VisitPatient extends Component
{
    public $search = '';
    public $isLoading = true;

    public function render() {
        try {
            $this->isLoading = true;
            $results = DB::table('master.pasien AS p')
            ->leftJoin('pendaftaran.pendaftaran AS pd', 'p.norm', '=', 'pd.norm')
            ->leftJoin('pendaftaran.kunjungan AS pk', 'pk.nopen', '=', 'pd.norm')
            ->leftJoin('master.wilayah AS mw', 'p.wilayah', '=', 'mw.id')
            ->leftJoin('pendaftaran.tujuan_pasien AS pt', 'pd.nomor', '=', 'pt.nopen')
            ->leftJoin('master.ruangan AS mr', 'pt.ruangan', '=', 'mr.id')
            ->leftJoin('pendaftaran.penjamin AS pp', 'pd.nomor', '=', 'pp.nopen')
            ->leftJoin('master.dokter AS md', 'pt.dokter', '=', 'md.id')
            ->leftJoin('master.pegawai AS mp', 'md.nip', '=', 'mp.nip')
            ->leftJoin('master.kartu_identitas_pasien AS mk', 'p.norm', '=', 'mk.norm')
            ->select([
                'p.norm AS NORM',
                DB::raw("CONCAT(p.gelar_depan, ' ', p.nama) AS PASIEN"),
                'mk.nomor AS NIK',
                'pd.nomor AS NOPEN',
                'mr.deskripsi AS RUANGAN',
                'mp.nama AS DOKTER',
                DB::raw("CASE
                    WHEN pd.status = 0 THEN 'Batal'
                    WHEN pd.status = 1 THEN 'Aktif'
                    WHEN pd.status = 2 THEN 'Selesai'
                    ELSE ''
                END AS STATUS"),
                DB::raw("CASE
                    WHEN pp.jenis = 1 THEN 'Tanpa Asuransi / Umum'
                    WHEN pp.jenis = 2 THEN 'BPJS Kesehatan'
                    WHEN pp.jenis = 3 THEN 'ADMEDIKA'
                    WHEN pp.jenis = 4 THEN 'GARDA MEDIKA'
                    WHEN pp.jenis = 5 THEN 'PT. Jasa Raharja'
                    WHEN pp.jenis = 6 THEN 'MANDIRI INHEALTH'
                    WHEN pp.jenis = 7 THEN 'BPJS Ketenagakerjaan'
                    WHEN pp.jenis = 8 THEN 'KEMENKES'
                    WHEN pp.jenis = 9 THEN 'SINARMAS'
                    ELSE ''
                END AS PENJAMIN"),
            ])
            ->whereDate('pd.tanggal', DB::raw('CURDATE()'))
            ->where(function ($query) {
                if (!empty($this->search)) {
                    $query->where('p.nama', 'like', '%' . $this->search . '%');
                }
            })
            ->orderBy('pd.tanggal', 'DESC')
            ->get();
            dd($results);
            return view('livewire.visit-patient');
        } catch (\Exception $e) {
            return response('Terjadi kesalahan: ' . $e->getMessage(), 500);
        } finally {
            $this->isLoading = false;
        }
    }
}
