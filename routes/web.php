<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(PageController::class)->group(function() {
    Route::get('/daftar-dokter', 'doctor')->name('list.doctor');
    Route::get('pendaftaran-pasien', 'patient_registration')->name('list.registration');
    Route::get('kunjungan-pasien', 'visit_patient')->name('visit.patient');
    Route::get('/generate-sheet', 'generateSheet')->name('generate-sheet');
});