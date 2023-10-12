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
            </div>
        </div>
    </div>
    <livewire:visit-patient lazy="on-load" />
@endsection