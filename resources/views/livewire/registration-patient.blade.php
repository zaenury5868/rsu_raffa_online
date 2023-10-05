<div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row g-4">
                <div class="col-md-8 col-lg-4">
                    <div class="card card-sponsor" target="_blank" rel="noopener" style="background-image: url(./cs.jpg)" aria-label="Pasien Terbanyak oleh CS">
                        <div class="d-flex flex-column justify-content-center align-items-center card-body">
                            <h1 class="text-capitalize text-secondary text-center">pasien terbanyak</h1>
                            <h2 class="text-lime">{{ $bestName }}</h2>
                            <p class="text-center">Jumlah total pasien yang didaftarkan <strong>{{ $countData }}</strong> pasien</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-lg-4">
                    <div class="card card-sponsor" target="_blank" rel="noopener" style="background-image: url(./cs.jpg)" aria-label="Pasien Terbanyak oleh CS">
                        <div class="d-flex flex-column justify-content-center align-items-center card-body">
                            <h1 class="text-capitalize text-secondary text-center">pasien terbanyak</h1>
                            <h2 class="text-lime">{{ $bestName }}</h2>
                            <p class="text-center">Jumlah total pasien yang didaftarkan <strong>{{ $countData }}</strong> pasien</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-lg-4">
                    <div class="card card-sponsor" target="_blank" rel="noopener" style="background-image: url(./cs.jpg)" aria-label="Pasien Terbanyak oleh CS">
                        <div class="d-flex flex-column justify-content-center align-items-center card-body">
                            <h1 class="text-capitalize text-secondary text-center">pasien terbanyak</h1>
                            <h2 class="text-lime">{{ $bestName }}</h2>
                            <p class="text-center">Jumlah total pasien yang didaftarkan <strong>{{ $countData }}</strong> pasien</p>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card bg-white">
                        <div class="card-body border-bottom py-3">
                            <div class="d-flex">
                                <div class="text-muted">
                                    Daftar nama pasien yang telah didaftaran oleh customer services 
                                </div>
                                <div class="ms-auto text-muted">
                                    Pencarian nama/norm/nik pasien/tujuan unit/nama cs:
                                    <div class="ms-2 d-inline-block">
                                        <input type="text" class="form-control form-control-sm" aria-label="Search invoice" wire:model.lazy="search">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            @if (!$isLoading)
                                <table class="table card-table table-bordered table-vcenter text-nowrap datatable h6">
                                    <thead>
                                        <tr>
                                            <th class="w-1 text-center">No</th>
                                            <th class="w-1">NORM</th>
                                            <th class="w-1 text-center">PASIEN</th>
                                            <th class="w-1 text-center">NIK</th>
                                            <th class="w-1">JENIS KELAMIN</th>
                                            <th class="w-1">TANGGAL LAHIR</th>
                                            <th class="w-1">UMUR</th>
                                            <th class="w-1 text-center">ALAMAT</th>
                                            <th class="w-1">WILAYAH</th>
                                            <th class="w-1">TANGGAL DIDAFTARKAN</th>
                                            <th class="w-1 text-center">OLEH</th>
                                            <th class="w-1">NOMOR PENDAFTARAN</th>
                                            <th class="w-1 text-center">PENJAMIN</th>
                                            <th class="w-1 text-center">TUJUAN UNIT</th>
                                            <th class="w-1 text-center">DOKTER</th>
                                            <th class="w-1 text-center">SEP</th>
                                            <th class="w-1">STATUS PENDAFTARAN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($results as $item)
                                            <tr data-id="{{ $item->NORM }}" onclick="highlightRow(this)">
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>{{ $item->NORM ?? '-' }}</td>
                                                <td>{!! $item->PASIEN ?? '<span class="badge bg-danger w-100">Kosong</span>' !!}</td>
                                                <td>{!! $item->NIK != '-' ? $item->NIK : '<span class="badge bg-danger w-100">Kosong</span>' !!}</td>
                                                <td>{{ $item->JENIS_KELAMIN ?? '-' }}</td>
                                                <td>{{ $item->TANGGAL_LAHIR ?? '-' }}</td>
                                                <td>{{ $item->UMUR ?? '-' }}</td>
                                                <td>{!! !is_null($item->ALAMAT) ? $item->ALAMAT : '<span class="badge bg-danger w-100">Kosong</span>' !!}</td>
                                                <td>{{ $item->WILAYAH ?? '-' }}</td>
                                                <td>{{ $item->TANGGAL_DIDAFTARKAN ?? '-' }}</td>
                                                <td>{{ $item->OLEH ?? '-' }}</td>
                                                <td class="text-center">{{ $item->NOPEN ?? '-' }}</td>
                                                <td>{{ $item->PENJAMIN ?? '-' }}</td>
                                                <td>{{ $item->RUANGAN ?? '-' }}</td>
                                                <td>{{ $item->DOKTER ?? '-' }}</td>
                                                <td>{{ $item->SEP ?? '-' }}</td>
                                                <td class="text-center">
                                                    <span class="badge {{ $item->STATUS == 'Batal' ? 'bg-danger' : ($item->STATUS == 'Aktif' ? 'bg-warning' : 'bg-success') }} me-1"></span>{{ $item->STATUS ?? '-' }}
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="17" class="text-center">Tidak ada data</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
