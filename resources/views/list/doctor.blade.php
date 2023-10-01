@extends('layout.base')
@section('title', isset($title) ? $title : 'Registrasi Pasien - RSU Raffa Majenang')
@section('content')
    <livewire:list-doctor lazy="on-load" />
@endsection