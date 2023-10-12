@extends('layout.base')
@section('title', isset($title) ? $title : 'Daftar Dokter - RSU Raffa Majenang')
@section('content')
    <livewire:list-doctor lazy="on-load" />
@endsection