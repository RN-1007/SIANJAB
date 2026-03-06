<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title font-weight-bold"><i class="fas fa-exclamation-triangle mr-2 text-warning"></i> Data
                    Uraian Tugas</h3>
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
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered table-striped" style="overflow-x: auto; width: 100%;">
                    <colgroup>
                        <col style="width: 45px;"> <!-- No -->
                        <col style="width: 300px;"> <!-- Tugas dan Fungsi -->
                        <col style="width: 100px;"> <!-- Uraian Tugas Staf -->
                        <col style="width: 100px;"> <!-- Hasil Kerja Staf -->
                        <col style="width: 80px;"> <!-- Satuan Hasil -->
                        <col style="width: 80px;"> <!-- Target -->
                        <col style="width: 85px;"> <!-- Frekuensi/Shift -->
                        <col style="width: 80px;"> <!-- Volume -->
                        <col style="width: 170px;"> <!-- Waktu Penyelesaian -->
                        <col style="width: 90px;"> <!-- Nama Jabatan -->
                        <col style="width: 80px;"> <!-- Action -->
                    </colgroup>
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Tugas dan Fungsi</th>
                            <th>Uraian Tugas Staf</th>
                            <th>Hasil Kerja Staf</th>
                            <th>Satuan Hasil</th>
                            <th>Target</th>
                            <th>Frekuensi/Shift</th>
                            <th>Volume</th>
                            <th>Waktu Penyelesaian (menit)</th>
                            <th>Nama Jabatan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($daftarTusi as $index => $tusi)
                            <tr style="line-height: 1; height: 28px;">
                                <td class="text-center font-weight-bold">{{ $index + 1 }}.</td>
                                <td>{{ $tusi->tusi }}</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-warning mb-2"
                                        wire:click="prepareToCreate({{ $tusi->id }})">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <!-- Modal Tambah -->
        <div wire:ignore.self class="modal fade" id="tambah-tugas" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <form wire:submit.prevent="saveUraianTugas">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Tambah Data</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="tusi">Tugas dan Fungsi : </label>
                                <input type="number" class="form-control" id="tusi"
                                    value="{{ $selectedTusi?->id }}" disabled>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" rows="3" placeholder="Enter ..." disabled>{{ $selectedTusi?->tusi }}</textarea>
                            </div>
                            <div class="form-group">
                                <input type="number" class="form-control" id="tugas"
                                    value="{{ $selectedTusi?->code_tusi }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="uraiantugas">Uraian Tugas : </label>
                                <textarea class="form-control @error('uraian_tugas_staf') is-invalid @enderror" rows="3"
                                    placeholder="Masukkan uraian tugas Anda di sini..." wire:model="uraian_tugas_staf"></textarea>
                                @error('uraian_tugas_staf')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="hasilkerja">Hasil Kerja : </label>
                                <input type="text"
                                    class="form-control @error('hasil_kerja_staf') is-invalid @enderror" id="hasilkerja"
                                    placeholder="Hasil Kerja..." wire:model="hasil_kerja_staf">
                                @error('hasil_kerja_staf')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="satuanhasil">Satuan Hasil : </label>
                                <input type="text" class="form-control @error('satuan_hasil') is-invalid @enderror"
                                    id="satuanhasil" placeholder="Satuan Kerja..." wire:model="satuan_hasil">
                                @error('satuan_hasil')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="target">Target : </label>
                                <input type="number" class="form-control @error('target') is-invalid @enderror"
                                    id="target" placeholder="Target..." wire:model="target">
                                @error('target')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Frekuensi / Shift :</label>
                                <select class="form-control" wire:model="frekuensi" style="width: 100%;">
                                    <option value="" disabled>Pilih Frekuensi</option>
                                    <option value="235">5 Hari Kerja(235)</option>
                                    <option value="1">Tahunan (1)</option>
                                    <option value="2">Semesteran (2)</option>
                                    <option value="3">Caturwulanan (3)</option>
                                    <option value="4">Triwulanan (4)</option>
                                    <option value="6">Dwi bulan (6)</option>
                                    <option value="12">Bulanan (12)</option>
                                    <option value="52">Mingguan (52)</option>
                                    <option value="287">6 Hari Kerja (287)</option>
                                    <option value="365">Setiap Hari (365)</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="waktu">Waktu Penyelesaian : </label>
                                <input type="number"
                                    class="form-control @error('waktu_penyelesaian') is-invalid @enderror"
                                    id="waktu" placeholder="Waktu..." wire:model="waktu_penyelesaian">
                                <span class="text-danger font-weight-bold">*Maskimal waktu di isi
                                    330</span>
                                @error('waktu_penyelesaian')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer justify-content-end">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">
                                <span wire:loading.remove wire:target="saveUraianTugas">Save</span>
                                <span wire:loading wire:target="saveUraianTugas">Saving...</span>
                            </button>
                        </div>
                    </div>
                </form>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

    </div>
    <!-- /.col -->
</div>
