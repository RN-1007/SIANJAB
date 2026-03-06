<div>
    {{-- Tombol Tambah Admin dengan warna berbeda (btn-warning) --}}
    <button type="button" data-toggle="modal" data-target="#addAdminModal" class="mt-2 btn btn-sm btn-warning ml-2">
        <i class="fas fa-user-shield"></i> Admin
    </button>

    {{-- Modal untuk Tambah Admin --}}
    <div wire:ignore.self class="modal fade" id="addAdminModal" tabindex="-1" role="dialog" aria-labelledby="addAdminModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="addAdminModalLabel">Tambah Data Master Admin</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="store">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="username_admin">Username <span class="text-danger">*</span></label>
                                    <input type="text" id="username_admin" class="form-control @error('username') is-invalid @enderror" wire:model.live="username" placeholder="Masukkan username" required>
                                    @error('username') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="form-group">
                                    <label for="jabatan_admin">Nama Jabatan <span class="text-danger">*</span></label>
                                    <input type="text" id="jabatan_admin" class="form-control @error('jabatan') is-invalid @enderror" wire:model="jabatan" placeholder="cth: Administrator Sistem" required>
                                    @error('jabatan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="form-group">
                                    <label for="status_admin">Status <span class="text-danger">*</span></label>
                                    <select id="status_admin" class="form-control @error('status') is-invalid @enderror" wire:model.live="status" required>
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                    @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password_admin">Password <span class="text-danger">*</span></label>
                                    <input type="password" id="password_admin" class="form-control @error('password') is-invalid @enderror" wire:model="password" placeholder="Masukkan password" required>
                                    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="password_confirmation_admin">Konfirmasi Password <span class="text-danger">*</span></label>
                                    <input type="password" id="password_confirmation_admin" class="form-control" wire:model="password_confirmation" placeholder="Konfirmasi password" required>
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