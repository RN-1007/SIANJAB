<div wire:ignore.self class="modal fade" id="addJabatanInlineModal" tabindex="-1" role="dialog" aria-labelledby="addJabatanInlineModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form wire:submit.prevent="store">
                <div class="modal-header">
                    <h5 class="modal-title" id="addJabatanInlineModalLabel">Tambah {{ $tipeAnak }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Jabatan Induk</label>
                        <input type="text" class="form-control" value="{{ $parentName }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="nama_jabatan_inline">Nama Jabatan</label>
                        <input type="text" wire:model="nama_jabatan" id="nama_jabatan_inline" class="form-control @error('nama_jabatan') is-invalid @enderror" placeholder="Masukkan nama jabatan baru">
                        @error('nama_jabatan') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                     <div class="form-group">
                        <label for="kelas_jabatan_inline">Kelas Jabatan</label>
                        <input type="number" wire:model="kelas_jabatan" id="kelas_jabatan_inline" class="form-control @error('kelas_jabatan') is-invalid @enderror" placeholder="Masukkan kelas jabatan">
                        @error('kelas_jabatan') <span class="text-danger">{{ $message }}</span> @enderror
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