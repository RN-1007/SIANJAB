<div>
    <button type="button" data-toggle="modal" data-target="#addModal" class="mt-2 btn btn-sm btn-primary">
        <i class="fas fa-plus"></i> User
    </button>

    <div wire:ignore.self class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="addModalLabel">Tambah Data Master User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="store">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="id_pd">Perangkat Daerah <span class="text-danger">*</span></label>
                                    <select id="select-pd" class="form-control" wire:model.live="id_pd" style="width: 100%;">
                                        <option value="">-- Pilih Perangkat Daerah --</option>
                                        @foreach ($perangkatDaerahs as $pd)
                                            <option value="{{ $pd->id }}">{{ $pd->nama_pd }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_pd') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="id_jabatan">Struktur Jabatan <span class="text-danger">*</span></label>
                                    <select class="form-control @error('id_jabatan') is-invalid @enderror" wire:model="id_jabatan" @if(!$id_pd) disabled @endif>
                                        <option value="">-- Pilih Struktur Jabatan --</option>
                                        @foreach ($strukturJabatans as $jabatan)
                                            <option value="{{ $jabatan->id }}">{{ $jabatan->nama_jabatan }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_jabatan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="username">Username <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('username') is-invalid @enderror" wire:model.live="username" placeholder="Masukkan username" required>
                                    @error('username') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="form-group">
                                    <label for="role">Role <span class="text-danger">*</span></label>
                                    <select class="form-control @error('role') is-invalid @enderror" wire:model.live="role" required>
                                        <option value="user">User</option>
                                        <option value="kepala">Kepala</option>
                                    </select>
                                    @error('role') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="jabatan_staf">Jabatan Staf <span class="text-danger">*</span></label>
                                    <select class="form-control @error('jabatan_staf') is-invalid @enderror" wire:model.live="jabatan_staf" @if($role !== 'user') disabled @endif>
                                        <option value="">Pilih Jabatan Staf</option>
                                        <option value="pelaksana">Pelaksana</option>
                                        <option value="fungsional">Fungsional</option>
                                        <!-- <option value="penunjang">Penunjang</option> -->
                                    </select>
                                    @error('jabatan_staf') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status">Status <span class="text-danger">*</span></label>
                                    <select class="form-control @error('status') is-invalid @enderror" wire:model.live="status" required>
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                    @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="form-group">
                                    <label for="password">Password <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" wire:model="password" placeholder="Masukkan password" required>
                                    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="password_confirmation">Konfirmasi Password <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" wire:model="password_confirmation" placeholder="Konfirmasi password" required>
                                </div>
                               
                                {{-- PERUBAHAN DI SINI --}}
                                <div class="form-group">
                                    <label for="jabatan">Nama Jabatan <span class="text-danger">*</span></label>
                                    <input type="text" id="jabatan" class="form-control @error('jabatan') is-invalid @enderror" wire:model="jabatan" placeholder="Masukkan nama jabatan" required>
                                    @error('jabatan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                            <span wire:loading.remove>Simpan</span>
                            <span wire:loading>Menyimpan...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>