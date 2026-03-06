<div>
    {{-- Tombol untuk membuka modal --}}
    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addJabatanModal">
        <i class="fas fa-plus"></i> Tambah Jabatan Pimpinan
    </button>

    {{-- Modal --}}
    <div wire:ignore.self class="modal fade" id="addJabatanModal" tabindex="-1" role="dialog" aria-labelledby="addJabatanModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form wire:submit.prevent="store">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addJabatanModalLabel">Tambah Jabatan Pimpinan / Fungsional / Staf Ahli</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        
                        {{-- Dropdown Perangkat Daerah --}}
                        <div class="form-group">
                            <label for="id_pd">Perangkat Daerah (PD)</label>
                            <select wire:model="id_pd" id="id_pd" class="form-control select2bs4 @error('id_pd') is-invalid @enderror">
                                <option value="">-- Pilih PD yang Belum Memiliki Pimpinan --</option>
                                @foreach($perangkatDaerahs as $pd)
                                    <option value="{{ $pd->id }}">{{ $pd->nama_pd }}</option>
                                @endforeach
                            </select>
                            @error('id_pd') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        {{-- Input Nama Jabatan --}}
                        <div class="form-group">
                            <label for="nama_jabatan">Nama Jabatan</label>
                            <input type="text" wire:model.defer="nama_jabatan" id="nama_jabatan" class="form-control @error('nama_jabatan') is-invalid @enderror" placeholder="cth: Sekretaris Daerah">
                            @error('nama_jabatan') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                {{-- Select Tipe Jabatan (Sudah benar sesuai permintaan) --}}
                                <div class="form-group">
                                    <label for="tipe_jabatan">Tipe Jabatan</label>
                                    <select wire:model="tipe_jabatan" id="tipe_jabatan" class="form-control @error('tipe_jabatan') is-invalid @enderror">
                                        <option value="">-- Pilih Tipe --</option>
                                        <option value="Pimpinan Tinggi">Pimpinan Tinggi</option>
                                        <option value="Jabatan Fungsional">Jabatan Fungsional</option>
                                        <option value="Staf Ahli">Staf Ahli</option>
                                    </select>
                                    @error('tipe_jabatan') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                {{-- Input Kelas Jabatan --}}
                                <div class="form-group">
                                    <label for="kelas_jabatan">Kelas Jabatan</label>
                                    <input type="number" wire:model.defer="kelas_jabatan" id="kelas_jabatan" class="form-control @error('kelas_jabatan') is-invalid @enderror" placeholder="cth: 15">
                                    @error('kelas_jabatan') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
