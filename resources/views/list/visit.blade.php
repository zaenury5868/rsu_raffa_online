@extends('layout.base')
@section('title', isset($title) ? $title : 'Kunjungan Pasien - RSU Raffa Majenang')
@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="card-body">
                    <ol class="breadcrumb breadcrumb-arrows">
                        <li class="breadcrumb-item text-capitalize"><a href="#">daftar dokter</a></li>
                        <li class="breadcrumb-item text-capitalize disabled"><a href="#">kunjungan pasien</a></li>
                    </ol>
                </div>
                <div class="col" style="display: grid; grid-template-columns: 1fr auto auto auto;">
                    <h2 class="page-title text-capitalize">
                        Daftar Registrasi Pasien Hari Ini &nbsp;
                        <span class="badge">{{ \Carbon\Carbon::now()->format('d F Y') }}</span>
                    </h2>
                    <div class="d-flex align-items-center me-2">
                        <span>Filter</span>
                        <input type="date" class="form-control ms-2">
                    </div>
                    <button id="registration-patient" class="btn btn-blue text-capitalize">Lihat Pasien</button>
                </div>                
            </div>
        </div>
    </div>
    {{-- <livewire:registration-patient lazy="on-load" /> --}}
@endsection