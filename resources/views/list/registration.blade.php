@extends('layout.base')
@section('title', isset($title) ? $title : 'Registrasi Pasien - RSU Raffa Majenang')
@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col d-flex">
                    <h2 class="page-title text-capitalize flex-wrap flex-grow-1">
                        daftar registrasi pasien hari ini
                    </h2>
                    <button id="registration-patient" class="btn btn-blue text-capitalize">download rekap pasien</button>
                </div>
            </div>
        </div>
    </div>
    <livewire:registration-patient lazy="on-load" />
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#registration-patient').click(function(e) {
                e.preventDefault();
                preview();
            });
        });

        const preview = () => {
            $.ajax({
                url: '{{ route("generate-sheet") }}',
                method: 'GET',
                beforeSend: (request) => {
                    $.blockUI({
                        css: {
                            backgroundColor: 'transparent',
                            border: 'none',
                            centerX: true,
                            centerY: true
                        },
                        message: '<div class="custom-loader"></div>',
                        baseZ: 1500,
                        overlayCSS: {
                            backgroundColor: '#7C7C7C',
                            opacity: 0.4,
                            cursor: 'wait'
                        }
                    });
                },
                success: (response) => {
                    $.unblockUI();
                    var redirectUrl = response.url;
                    console.log(redirectUrl);
                    var newTab = window.open(redirectUrl, '_blank');
                    newTab.focus();
                },
                error: (xhr, status, error) => {
                    console.log('Internal server error:', error);
                }
            });
        };
    </script>
@endpush