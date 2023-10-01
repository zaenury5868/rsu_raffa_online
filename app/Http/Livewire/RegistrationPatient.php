<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class RegistrationPatient extends Component
{
    public $results;
    public $search = '';
    public $isLoading = true;

    public function render() {
        $this->isLoading = true;
        $this->results = DB::table('master.pasien AS p')
                        ->leftJoin('pendaftaran.pendaftaran AS pd', 'p.norm', '=', 'pd.norm')
                        ->leftJoin('aplikasi.pengguna AS pg', 'pd.oleh', '=', 'pg.id')
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
                            DB::raw("CASE WHEN p.jenis_kelamin = 1 THEN 'Laki-laki' WHEN p.jenis_kelamin = 2 THEN 'Perempuan' ELSE '' END AS JENIS_KELAMIN"),
                            DB::raw("DATE_FORMAT(p.tanggal_lahir, '%d %M %Y') AS TANGGAL_LAHIR"),
                            DB::raw("CONCAT(YEAR(CURDATE()) - YEAR(p.tanggal_lahir) - (DATE_FORMAT(CURDATE(), '%m%d') < DATE_FORMAT(p.tanggal_lahir, '%m%d')), ' tahun') AS UMUR"),
                            DB::raw("CONCAT(p.alamat, ' RT ', p.rt, ' RW ', p.rw) AS ALAMAT"),
                            'mw.deskripsi AS WILAYAH',
                            'pd.tanggal AS TANGGAL_DIDAFTARKAN',
                            'pg.nama AS OLEH',
                            'pd.nomor AS NOPEN',
                            'mr.deskripsi AS RUANGAN',
                            'mp.nama AS DOKTER',
                            'pp.nomor AS SEP',
                            DB::raw("CASE
                                WHEN pd.status = 0 THEN 'Dibatalkan'
                                WHEN pd.status = 1 THEN 'Sedang dilayani'
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
                                $query->where('p.nama', 'like', '%' . $this->search . '%')
                                        ->orWhere('p.norm', 'like', '%' . $this->search . '%')
                                        ->orWhere('mk.nomor', 'like', '%' . $this->search . '%')
                                        ->orWhere('pg.nama', 'like', '%' . $this->search . '%');
                            }
                        })
                        ->orderBy('pd.tanggal', 'ASC')
                        ->orderBy('pg.nama', 'ASC')
                        ->get();
        $this->isLoading = false;
        return view('livewire.registration-patient', ['results' => $this->results]);
    }
}
