<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class ListDoctor extends Component
{
    public $results;
    public $isLoading = true;
    public function render() {
        $this->isLoading = true;
        $this->results = DB::table('jadwal_dokter_hfis')
                    ->whereNotIn('kd_dokter', [386741, 32378, 456232, 449435, 222221, 553795])
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
        $this->isLoading = false;
        return view('livewire.list-doctor', ['results' => $this->results]);
    }
}
