<div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row g-4">
                <div class="col-12">
                    <div class="card bg-white">
                        <div class="card-body border-bottom py-3">
                            <div class="d-flex">
                                <div class="text-muted">
                                    Daftar riwayat kunjungan pasien
                                </div>
                                <div class="ms-auto text-muted">
                                    Pencarian nama pasien/norm/nik pasien/tujuan unit/nopen/kunjungan:
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
                                            <th class="w-1 text-center">PENJAMIN</th>
                                            <th class="w-1">TANGGAL MASUK</th>
                                            <th class="w-1">TANGGAL KELUAR</th>
                                            <th class="w-1 text-center">OLEH</th>
                                            <th class="w-1">NOPEN</th>
                                            <th class="w-1 text-center">TUJUAN UNIT</th>
                                            <th class="w-1 text-center">DOKTER</th>
                                            <th class="w-1">STATUS KUNJUNGAN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
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
