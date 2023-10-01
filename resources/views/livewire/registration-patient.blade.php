<div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row g-4">
                <div class="col-12">
                    <div class="card bg-white">
                        <div class="card-body border-bottom py-3">
                            <div class="d-flex">
                                <div class="text-muted">
                                    Daftar nama pasien yang telah didaftaran oleh customer services 
                                </div>
                                <div class="ms-auto text-muted">
                                    Pencarian nama/nik pasien:
                                    <div class="ms-2 d-inline-block">
                                        <input type="text" class="form-control form-control-sm" aria-label="Search invoice" wire:model.lazy="search">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table card-table table-vcenter text-nowrap datatable h6">
                                <thead>
                                    <tr>
                                        <th class="w-1 text-center">No</th>
                                        <th class="w-1">NORM</th>
                                        <th class="w-1">PASIEN</th>
                                        <th class="w-1">NIK</th>
                                        <th class="w-1">JENIS KELAMIN</th>
                                        <th class="w-1">TANGGAL LAHIR</th>
                                        <th class="w-1">UMUR</th>
                                        <th class="w-1">ALAMAT</th>
                                        <th class="w-1">WILAYAH</th>
                                        <th class="w-1">TANGGAL DIDAFTARKAN</th>
                                        <th class="w-1">OLEH</th>
                                        <th class="w-1">NOMOR PENDAFTARAN</th>
                                        <th class="w-1">PENJAMIN</th>
                                        <th class="w-1">RUANGAN</th>
                                        <th class="w-1">DOKTER</th>
                                        <th class="w-1">SEP</th>
                                        <th class="w-1">STATUS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($results as $item)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $item->NORM ?? '-' }}</td>
                                            <td>{{ $item->PASIEN ?? '-' }}</td>
                                            <td>{{ $item->NIK ?? '-' }}</td>
                                            <td>{{ $item->JENIS_KELAMIN ?? '-' }}</td>
                                            <td>{{ $item->TANGGAL_LAHIR ?? '-' }}</td>
                                            <td>{{ $item->UMUR ?? '-' }}</td>
                                            <td>{{ $item->ALAMAT ?? '-' }}</td>
                                            <td>{{ $item->WILAYAH ?? '-' }}</td>
                                            <td>{{ $item->TANGGAL_DIDAFTARKAN ?? '-' }}</td>
                                            <td>{{ $item->OLEH ?? '-' }}</td>
                                            <td>{{ $item->NOPEN ?? '-' }}</td>
                                            <td>{{ $item->PENJAMIN ?? '-' }}</td>
                                            <td>{{ $item->RUANGAN ?? '-' }}</td>
                                            <td>{{ $item->DOKTER ?? '-' }}</td>
                                            <td>{{ $item->SEP ?? '-' }}</td>
                                            <td>
                                                <span class="badge {{ $item->STATUS == 'Dibatalkan' ? 'bg-danger' : ($item->STATUS == 'Sedang dilayani' ? 'bg-warning' : 'bg-success') }} me-1"></span>{{ $item->STATUS ?? '-' }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="13" class="text-center">Tidak ada data</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
