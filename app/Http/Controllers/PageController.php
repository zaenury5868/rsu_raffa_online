<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Services\GoogleSheetServices;

class PageController extends Controller
{
    protected $googleSheetService;

    public function __construct(GoogleSheetServices $googleSheetService) {
        $this->googleSheetService = $googleSheetService;
    }

    public function doctor() {
        return \view('list.doctor');
    }

    public function patient_registration() {
        return \view('list.registration');
    }

    public function generateSheet(Request $request) {
        $filterDate = $request->input('date');
        $query = DB::table('master.pasien AS p')
            ->leftJoin('pendaftaran.pendaftaran AS pd', 'p.norm', '=', 'pd.norm')
            ->leftJoin('aplikasi.pengguna AS pg', 'pd.oleh', '=', 'pg.id')
            ->leftJoin('master.wilayah AS mw', 'p.wilayah', '=', 'mw.id')
            ->leftJoin('pendaftaran.tujuan_pasien AS pt', 'pd.nomor', '=', 'pt.nopen')
            ->leftJoin('master.ruangan AS mr', 'pt.ruangan', '=', 'mr.id')
            ->leftJoin('pendaftaran.penjamin AS pp', 'pd.nomor', '=', 'pp.nopen')
            ->leftJoin('master.dokter AS md', 'pt.dokter', '=', 'md.id')
            ->leftJoin('master.pegawai AS mp', 'md.nip', '=', 'mp.nip')
            ->select([
                'p.norm AS NORM',
                DB::raw("COALESCE(CONCAT(p.gelar_depan, ' ', p.nama), '') AS PASIEN"),
                DB::raw("CASE WHEN p.jenis_kelamin = 1 THEN 'Laki-laki' WHEN p.jenis_kelamin = 2 THEN 'Perempuan' ELSE '' END AS JENIS_KELAMIN"),
                DB::raw("COALESCE(DATE_FORMAT(p.tanggal_lahir, '%d %M %Y'), '') AS TANGGAL_LAHIR"),
                DB::raw("COALESCE(CONCAT(YEAR(CURDATE()) - YEAR(p.tanggal_lahir) - (DATE_FORMAT(CURDATE(), '%m%d') < DATE_FORMAT(p.tanggal_lahir, '%m%d')), ' tahun'), '') AS UMUR"),
                DB::raw("COALESCE(CONCAT(p.alamat, ' RT ', COALESCE(p.rt, ''), ' RW ', COALESCE(p.rw, '')), '') AS ALAMAT"),
                DB::raw("COALESCE(mw.deskripsi, '') AS WILAYAH"),
                DB::raw("COALESCE(pd.tanggal, '') AS TANGGAL_DIDAFTARKAN"),
                DB::raw("COALESCE(pg.nama, '') AS OLEH"),
                DB::raw("COALESCE(pd.nomor, '') AS NOPEN"),
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
                DB::raw("COALESCE(mr.deskripsi, '') AS RUANGAN"),
                DB::raw("COALESCE(mp.nama, '') AS DOKTER"),
                DB::raw("COALESCE(CASE WHEN pp.nomor = '' THEN '-' ELSE pp.nomor END, '') AS SEP"),
                DB::raw("COALESCE(CASE WHEN pd.status = 0 THEN 'Dibatalkan' WHEN pd.status = 1 THEN 'Sedang dilayani' WHEN pd.status = 2 THEN 'Selesai' ELSE '' END, '') AS STATUS"),
            ]);
        if (!empty($filterDate)) {
            $query->whereDate('pd.tanggal', $filterDate);
        } else {
            $query->whereDate('pd.tanggal', DB::raw('CURDATE()'));
        }
        
        $results = $query->orderBy('pd.tanggal', 'DESC')->get();
    
        $data = [];
    
        foreach ($results as $result) {
            $data[] = [
                $result->NORM,
                $result->PASIEN,
                $result->JENIS_KELAMIN,
                $result->TANGGAL_LAHIR,
                $result->UMUR,
                $result->ALAMAT,
                $result->WILAYAH,
                $result->TANGGAL_DIDAFTARKAN,
                $result->OLEH,
                $result->NOPEN,
                $result->PENJAMIN,
                $result->RUANGAN,
                $result->DOKTER,
                $result->SEP,
                $result->STATUS,
            ];
        }
    
        $redirectUrl = $this->googleSheetService->writeSheet($data, 2);
        return response()->json(['url' => $redirectUrl], Response::HTTP_OK);
    }
}
