<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Services\GoogleSheetServices;

class PageController extends Controller
{
    protected $googleSheetService;

    public function __construct(GoogleSheetServices $googleSheetService)
    {
        $this->googleSheetService = $googleSheetService;
    }

    public function doctor() {
        $results = DB::table('jadwal_dokter_hfis')
                    ->whereNotIn('kd_dokter', [386741, 32378, 456232, 449435, 222221])
                    ->whereIn('id', function ($query) {
                        $query->select(DB::raw('MAX(id)'))
                            ->from('jadwal_dokter_hfis')
                            ->groupBy('kd_dokter');
                    })
                    ->orderBy('id', 'desc')
                    ->select('jadwal_dokter_hfis.*', 
                        DB::raw("CONCAT(UCASE(LEFT(nm_dokter, 1)), LCASE(SUBSTRING(nm_dokter, 2))) AS nm_dokter"), 
                        DB::raw("CASE
                            WHEN kd_poli = 'BED' THEN 'Bedah'
                            WHEN kd_poli = 'INT' THEN 'Penyakit Dalam'
                            WHEN kd_poli = 'URO' THEN 'Urologi'
                            WHEN kd_poli = 'JAN' THEN 'Jantung'
                            WHEN kd_poli = 'OBG' THEN 'Obgyn (Kandungan)'
                            WHEN kd_poli = 'ANA' THEN 'Anak'
                            WHEN kd_poli = 'PAR' THEN 'Paru'
                            WHEN kd_poli = 'SAR' THEN 'Saraf'
                            WHEN kd_poli = 'ORT' THEN 'Orthopedi'
                            ELSE kd_poli
                        END AS NM_POLI"), 
                        DB::raw("CASE
                            WHEN kd_dokter = 433091 THEN ', Sp.B'
                            WHEN kd_dokter = 437119 THEN ', Sp.PD., MMR'
                            WHEN kd_dokter = 245014 THEN ', Sp.PD'
                            WHEN kd_dokter = 296359 THEN ', Sp.U'
                            WHEN kd_dokter = 217285 THEN ', Sp.JP'
                            WHEN kd_dokter = 530118 THEN ', Sp.OG'
                            WHEN kd_dokter = 539371 THEN ', Sp.A'
                            WHEN kd_dokter = 377630 THEN ', Sp.A'
                            WHEN kd_dokter = 496193 THEN ', Sp.N'
                            WHEN kd_dokter = 251413 THEN ', Sp.OT'
                            WHEN kd_dokter = 556786 THEN ', Sp.P'
                            ELSE kd_poli
                        END AS NM_Gelar"))
                    ->get();
        return \view('list.doctor', \compact('results'));
    }

    public function patient_registration() {
        return \view('list.registration');
    }

    public function generateSheet() {
        $results = DB::table('master.pasien AS p')
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
                DB::raw("CONCAT(p.gelar_depan, ' ', p.nama) AS PASIEN"),
                DB::raw("CASE WHEN p.jenis_kelamin = 1 THEN 'Laki-laki' WHEN p.jenis_kelamin = 2 THEN 'Perempuan' ELSE '' END AS JENIS_KELAMIN"),
                'p.tanggal_lahir AS TANGGAL_LAHIR',
                DB::raw("CONCAT(YEAR(CURDATE()) - YEAR(p.tanggal_lahir) - (DATE_FORMAT(CURDATE(), '%m%d') < DATE_FORMAT(p.tanggal_lahir, '%m%d')), ' tahun') AS UMUR"),
                DB::raw("CONCAT(p.alamat, ' RT ', p.rt, ' RW ', p.rw) AS ALAMAT"),
                'mw.deskripsi AS WILAYAH',
                'pd.tanggal AS TANGGAL_DIDAFTARKAN',
                'pg.nama AS OLEH',
                'mr.deskripsi AS RUANGAN',
                'mp.nama AS DOKTER',
                'pp.nomor AS SEP',
                DB::raw("CASE WHEN pd.status = 0 THEN 'Dibatalkan' WHEN pd.status = 1 THEN 'Sedang dilayani' WHEN pd.status = 2 THEN 'Selesai' ELSE '' END AS STATUS"),
            ])
            ->whereDate('pd.tanggal', DB::raw('CURDATE()'))
            ->orderBy('pg.nama', 'ASC')
            ->get();
                    
        foreach ($results as $key) {
            $data[] = [
                $key->NORM,
                $key->PASIEN,
                $key->JENIS_KELAMIN,
                $key->TANGGAL_LAHIR,
                $key->UMUR,
                $key->ALAMAT,
                $key->WILAYAH,
                $key->TANGGAL_DIDAFTARKAN,
                $key->OLEH,
                $key->RUANGAN,
                $key->DOKTER,
                $key->SEP,
                $key->STATUS,
            ];
        }
        $redirectUrl = $this->googleSheetService->writeSheet($data, 2);
        return response()->json(['url' => $redirectUrl], Response::HTTP_OK);
    }
}
