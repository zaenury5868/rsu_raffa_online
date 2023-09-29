@extends('layout.base')
@section('title', isset($title) ? $title : 'Registrasi Pasien - RSU Raffa Majenang')
@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title text-capitalize">
                        daftar dokter yang aktif
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row g-4">
                @foreach ($results as $item)
                <div class="col-md-6">
                    <div class="row row-cards">
                        <div class="space-y">
                            <div class="card">
                                <div class="row g-0">
                                    <div class="col-auto">
                                        <div class="card-body">
                                            @if ($item->KD_DOKTER == 556786)
                                                <div class="avatar avatar-lg" style="background-image: url('foto/DR.SANDY.png')"></div>
                                            @elseif ($item->KD_DOKTER == 245014)
                                                <div class="avatar avatar-lg" style="background-image: url('foto/DR.DHIKA.png')"></div>
                                            @elseif ($item->KD_DOKTER == 539371)
                                                <div class="avatar avatar-lg" style="background-image: url('foto/DR.MAHMUDAH.png')"></div>
                                            @elseif ($item->KD_DOKTER == 377630)
                                                <div class="avatar avatar-lg" style="background-image: url('foto/DR.HIDAYAT.png')"></div>
                                            @elseif ($item->KD_DOKTER == 251413)
                                                <div class="avatar avatar-lg" style="background-image: url('foto/DR.SURYA.png')"></div>
                                            @elseif ($item->KD_DOKTER == 437119)
                                                <div class="avatar avatar-lg" style="background-image: url('foto/DR.INDRA.png')"></div>
                                            @elseif ($item->KD_DOKTER == 530118)
                                                <div class="avatar avatar-lg" style="background-image: url('foto/DR.REZA.png')"></div>
                                            @elseif ($item->KD_DOKTER == 296359)
                                                <div class="avatar avatar-lg" style="background-image: url('foto/Untitled.png')"></div>
                                            @elseif ($item->KD_DOKTER == 217285)
                                                <div class="avatar avatar-lg" style="background-image: url('foto/DR.WINDHI.png')"></div>
                                            @elseif ($item->KD_DOKTER == 496193)
                                                <div class="avatar avatar-lg" style="background-image: url('foto/DR.SITI.png')"></div>
                                            @elseif ($item->KD_DOKTER == 433091)
                                                <div class="avatar avatar-lg" style="background-image: url('foto/DR.ANTON.png')"></div>
                                            @elseif ($item->KD_DOKTER == 25836)
                                                <div class="avatar avatar-lg" style="background-image: url('foto/DR.HANIFAH.png')"></div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="card-body ps-0">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="badge badge-outline fw-semibold text-capitalize">{{ $item->NM_POLI }}</div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-auto">
                                                    <div class="mt-3 badges">
                                                        <h2 class="mb-0">dr. {{ $item->nm_dokter }}{{ $item->NM_Gelar }}</h2>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-auto">
                                                    <div class="mt-3 badges">
                                                        <p>dr. {{ $item->nm_dokter }}{{ $item->NM_Gelar }}
                                                            @if ($item->KD_POLI == 'PAR')
                                                            merupakan dokter spesialis paru yang ahli dalam menangani berbagai penyakit dan gangguan paru-paru.
                                                            @elseif ($item->KD_POLI == 'INT')
                                                            merupakan dokter yang ahli dalam menangani kasus penyakit dalam
                                                            @elseif ($item->KD_POLI == 'ANA')
                                                            merupakan dokter spesialis anak yang ahli dalam menangani masalah kesehatan pada anak
                                                            @elseif ($item->KD_POLI == 'OBG')
                                                            merupakan dokter spesialis yang handal dalam membantu persalinan dan menangani masalah seputar kehamilan
                                                            @elseif ($item->KD_POLI == 'ORT')
                                                            merupakan dokter yang ahli dalam menangani berbagai kasus orthopedi dan traumatologi dengan subspesialisasi panggul dan lutut
                                                            @elseif ($item->KD_POLI == 'BED')
                                                            merupakan dokter spesialis bedah yang melayani konsultasi, pemeriksaan, dan tindakan bedah secara menyeluruh
                                                            @elseif ($item->KD_POLI == 'SAR')
                                                            merupakan dokter spesialis yang handal dalam menangani masalah kesehatan yang berkaitan dengan gangguan sistem saraf
                                                            @elseif ($item->KD_POLI == 'URO')
                                                            merupakan dokter spesialis ahli dalam mendiagnosis, mengobati, berbagai kondisi yang terkait dengan sistem kemih pada pria dan wanita, serta masalah pada sistem reproduksi pria
                                                            @elseif ($item->KD_POLI == 'JAN')
                                                            merupakan dokter spesialis yang dapat mendiagnosis berbagai kondisi jantung, termasuk penyakit arteri koroner, penyakit jantung iskemik, aritmia jantung, gagal jantung, penyakit katup jantung, serta kelainan bawaan jantung
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-auto">
                                                    <div class="mt-3 badges">
                                                        <a href="javascript:void(0)" class="text-capitalize fw-semibold text-decoration-none grow">lihat jadwal
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-badge-right-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                <path d="M7 6l-.112 .006a1 1 0 0 0 -.669 1.619l3.501 4.375l-3.5 4.375a1 1 0 0 0 .78 1.625h6a1 1 0 0 0 .78 -.375l4 -5a1 1 0 0 0 0 -1.25l-4 -5a1 1 0 0 0 -.78 -.375h-6z" stroke-width="0" fill="currentColor"></path>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection