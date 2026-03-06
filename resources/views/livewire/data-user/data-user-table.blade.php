<div>
    <div class="row">
        <div class="col-12">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title font-weight-bold">Cari Perangkat Deaerah</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div
                        style="
                                position: absolute;
                                bottom: 0;
                                left: 0;
                                width: 100% ;
                                height: 4px;
                                background: linear-gradient(90deg, #00c6ff, #0072ff);
                                border-radius: 5px;">
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group" wire:ignore>
                                <label>Perangkat Daerah</label>
                                <select class="select2" id="skpd-select" style="width: 100%;">
                                    <option value="">Pilih Perangkat Daerah</option>
                                    @foreach ($dataskpd as $skpd)
                                        <option value="{{ $skpd->id }}">{{ $skpd->nama_pd }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-12">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title font-weight-bold">Data Akses Semua Perangkat Daerah</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div
                        style="
                                position: absolute;
                                bottom: 0;
                                left: 0;
                                width: 100% ;
                                height: 4px;
                                background: linear-gradient(90deg, #00c6ff, #0072ff);
                                border-radius: 5px;">
                    </div>
                </div>

                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <colgroup>
                            <col style="width: 3%;"> 
                            <col style="width: 35%;">
                            <col style="width: 20%;">
                            <col style="width: 20%;">
                            <col style="width: 10%;">
                            {{-- PERBAIKAN: Menambahkan <col> ke-6 agar sesuai dengan jumlah header --}}
                            <col style="width: 12%;">
                        </colgroup>
                        <thead>
                            <tr>
                                <th style="width: 3%;">No</th>
                                <th>Nomenklatur Jabatan</th>
                                <th>Nama Jabatan Struktural</th>
                                <th>Nama Jabatan</th>
                                <th>Username</th>
                                <th>Akses</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($datajabatanstaf->count() > 0)
                                @foreach ($datajabatanstaf as $index => $item)
                                    <tr style="line-height: 1; height: 28px;">
                                        <td class="text-center align-middle">{{ $loop->iteration }}.</td>

                                        <td class="align-middle">
                                            {{ $item->nama_jabatan_struktural ?? '(Tidak ada parent)' }}</td>
                                        <td class="align-middle">{{ $item->nama_jabatan_user }}</td>
                                        <td class="align-middle">{{ $item->jabatan }}</td>
                                        <td class="align-middle">{{ $item->username }}</td>
                                        <td class="text-center align-middle">
                                            <button wire:click="toggleStatus({{ $item->iduser }})"
                                                class="btn btn-sm {{ $item->status === 'active' ? 'btn-success' : 'btn-danger' }}">
                                                {{ ucfirst($item->status) }}
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
</div>
