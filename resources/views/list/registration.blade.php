@extends('layout.base')
@section('title', isset($title) ? $title : 'Registrasi Pasien - RSU Raffa Majenang')
@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="card-body">
                    <ol class="breadcrumb breadcrumb-arrows">
                        <li class="breadcrumb-item text-capitalize"><a href="#">daftar dokter</a></li>
                        <li class="breadcrumb-item text-capitalize disabled"><a href="#">pendaftaran pasien</a></li>
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
    <livewire:registration-patient lazy="on-load" />
@endsection
@push('scripts')
    <script>
        var lastClickedRow = null; 
        const highlightRow = (row) => {
            if (lastClickedRow !== null) {
                lastClickedRow.style.backgroundColor = '';
            }

            var itemId = row.getAttribute('data-id');

            row.style.backgroundColor = "greenyellow";
            lastClickedRow = row;

            setTimeout(function () {
                row.style.backgroundColor = '';
            }, 3000);
        }

        $(document).ready(function() {
            function setTodayDate() {
                var today = new Date();
                var dd = String(today.getDate()).padStart(2, '0');
                var mm = String(today.getMonth() + 1).padStart(2, '0');
                var yyyy = today.getFullYear();
                var formattedDate = yyyy + '-' + mm + '-' + dd;

                $("input[type='date'].form-control.ms-2").val(formattedDate); 
            }

            setTodayDate();
            $('#registration-patient').click(function(e) {
                e.preventDefault();
                var date = $("input[type='date'].form-control.ms-2").val();
                preview(date);
            });
        });

        const preview = (date) => {
            console.log(date)
            $.ajax({
                url: '{{ route("generate-sheet") }}',
                method: 'GET',
                data: {date : date},
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