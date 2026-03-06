<div>
    <button type="button" data-toggle="modal" data-target="#modal-tambah" class="mt-2 btn btn-sm btn-primary">
        <i class="fas fa-plus"></i>
        Tambah Data Uraian Tugas
    </button>

    <div wire:ignore.self class="modal fade" id="modal-tambah">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form wire:submit.prevent="save">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Data Uraian Tugas Staf</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group" wire:ignore>
                            <label>Nama Jabatan (User)</label>
                            <select id="id_user_select" class="form-control" style="width: 100%;">
                                <option value="">-- Pilih Jabatan --</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->jabatan }}({{ $user->strukturJabatan->nama_jabatan ?? '-' }})</option>
                                @endforeach
                            </select>
                        </div>
                        @error('id_user')
                            <span class="text-danger d-block mt-1">{{ $message }}</span>
                        @enderror

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Jumlah PNS</label>
                                    <input type="number" wire:model="pns"
                                        class="form-control @error('pns') is-invalid @enderror" placeholder="0">
                                    @error('pns')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Jumlah CPNS</label>
                                    <input type="number" wire:model="cpns"
                                        class="form-control @error('cpns') is-invalid @enderror" placeholder="0">
                                    @error('cpns')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Jumlah PPPK</label>
                                    <input type="number" wire:model="pppk"
                                        class="form-control @error('pppk') is-invalid @enderror" placeholder="0">
                                    @error('pppk')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Jumlah NON PNS</label>
                                    <input type="number" wire:model="non_pns"
                                        class="form-control @error('non_pns') is-invalid @enderror" placeholder="0">
                                    @error('non_pns')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kelas Jabatan</label>
                                    <input type="number" wire:model="kelas_jabatan"
                                        class="form-control @error('kelas_jabatan') is-invalid @enderror"
                                        placeholder="0">
                                    @error('kelas_jabatan')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Jumlah Pemenuhan Pegawai</label>
                                    <input type="number" wire:model="pemenuhan_pegawai"
                                        class="form-control @error('pemenuhan_pegawai') is-invalid @enderror"
                                        placeholder="0">
                                    @error('pemenuhan_pegawai')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-end">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" wire:loading.attr="disabled" wire:target="save">
                            <span wire:loading.remove wire:target="save">Simpan</span>
                            <span wire:loading wire:target="save">Menyimpan...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
