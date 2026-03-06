    <div>
        @if($filterJabatanId)
            <div class="alert alert-info alert-dismissible fade show mb-3" role="alert">
                <i class="fas fa-filter mr-1"></i> 
                Menampilkan user untuk jabatan: <strong>{{ $filterJabatanName }}</strong>
                <button type="button" class="btn btn-sm btn-light ml-3" wire:click="resetFilter">
                    <i class="fas fa-times mr-1"></i> Reset Filter (Lihat Semua)
                </button>
            </div>
        @endif
        
        <table id="example1" class="table table-bordered table-striped table-sm table-lg-text">
            <thead>
                <tr>
                    <th class="text-center" style="width: 5%">No</th>
                    <th class="text-center" style="width: 15%">Username</th>
                    <th class="text-center" style="width: 10%">Role</th>
                    <th class="text-center" style="width: 10%">Status</th>
                    {{-- PERUBAHAN: Menambahkan Kolom Struktur Jabatan --}}
                    <th class="text-center" style="width: 20%">Struktur Jabatan</th>
                    <th class="text-center" style="width: 15%">Jabatan Staf</th>
                    <th class="text-center" style="width: 15%">Nama Jabatan (User)</th>
                    <th class="text-center" style="width: 10%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    @php
                        $roleColors = ['admin' => 'primary', 'user' => 'success', 'kepala' => 'warning'];
                        $badgeColor = $roleColors[$user->role] ?? 'secondary';
                    @endphp
                    <tr>
                        <td class="text-center font-weight-bold text-md">{{ $loop->iteration }}.</td>
                        <td class="text-md">{{ $user->username }}</td>
                        <td class="text-center">
                            <span class="badge text-sm badge-{{ $badgeColor }}">{{ ucfirst($user->role) }}</span>
                        </td>
                        <td class="text-center">
                            <span class="badge text-sm badge-{{ $user->status === 'active' ? 'success' : 'secondary' }}">
                                {{ ucfirst($user->status) }}
                            </span>
                        </td>
                        
                        {{-- PERUBAHAN: Menampilkan Nama Jabatan dari Tabel Struktur Jabatan --}}
                        <td class="text-md">
                            @if($user->strukturJabatan)
                                {{ $user->strukturJabatan->nama_jabatan }}
                                <br>
                                <small class="text-muted">
                                    ({{ $user->strukturJabatan->dataPd->nama_pd ?? '-' }})
                                </small>
                            @else
                                <span class="text-muted font-italic">-</span>
                            @endif
                        </td>

                        <td class="text-md">{{ $user->role === 'user' ? ucfirst($user->jabatan_staf) : '-' }}</td>
                        {{-- Nama Jabatan manual di tabel Users --}}
                        <td class="text-md"> 
                            @if ($user->role === 'admin' || $user->role === 'kepala')
                                <span>{{ $user->jabatan ?? '-' }}</span>
                            @else
                                <a href="{{ route('staf-user', $user->id) }}">{{ $user->jabatan ?? '-' }}</a>
                            @endif
                        </td>
                        
                        <td class="text-center">
                            <div class="btn-group" role="group">
                                @php
                                    $isLastAdmin = $user->role === 'admin' && $adminCount <= 1;
                                    $isSelf = $user->id === auth()->id();
                                @endphp
                                <button wire:click="edit({{ $user->id }})" class="btn btn-sm btn-info" title="Edit Data" @if ($isLastAdmin || $isSelf) disabled @endif>
                                    <i class="fas fa-pen"></i>
                                </button>
                                <button wire:click="confirmDelete({{ $user->id }})" class="btn btn-sm btn-danger" title="{{ $isLastAdmin || $isSelf ? 'Tidak dapat dihapus' : 'Hapus Data' }}" @if ($isLastAdmin || $isSelf) disabled @endif>
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="8" class="text-center">Data tidak ditemukan.</td></tr>
                @endforelse
            </tbody>
        </table>

        <div wire:ignore.self class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form wire:submit.prevent="update">
                        <div class="modal-header">
                            <h4 class="modal-title" id="editModalLabel">Edit Data Master User</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                
                                    <div class="form-group">
                                        <label>Username <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('username') is-invalid @enderror" wire:model="username">
                                        @error('username') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Role <span class="text-danger">*</span></label>
                                        <select class="form-control @error('role') is-invalid @enderror" wire:model="role" disabled>
                                            <option value="user">User</option>
                                            <option value="admin">Admin</option>
                                            <option value="kepala">Kepala</option>
                                        </select>
                                        @error('role') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    {{-- AKHIR PERUBAHAN --}}
                                    <div class="form-group">
                                        <label>Jabatan Staf <span class="text-danger">*</span></label>
                                        <select class="form-control @error('jabatan_staf') is-invalid @enderror" wire:model="jabatan_staf" @if($role !== 'user') disabled @endif>
                                            <option value="">Pilih Jabatan Staf</option>
                                            <option value="fungsional">Fungsional</option>
                                            <option value="pelaksana">Pelaksana</option>
                                            <!-- <option value="penunjang">Penunjang</option> -->
                                        </select>
                                        @error('jabatan_staf') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Status <span class="text-danger">*</span></label>
                                        <select class="form-control @error('status') is-invalid @enderror" wire:model="status">
                                            <option value="active">Active</option>
                                            <option value="inactive">Inactive</option>
                                        </select>
                                        @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Password Baru (Opsional)</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" wire:model="password" placeholder="Kosongkan jika tidak diubah">
                                        @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Konfirmasi Password Baru</label>
                                        <input type="password" class="form-control" wire:model="password_confirmation" placeholder="Konfirmasi password baru">
                                    </div>
                        
                                    <div class="form-group">
                                        <label>Nama Jabatan <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('jabatan') is-invalid @enderror" wire:model="jabatan">
                                        @error('jabatan') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-end">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary" wire:loading.attr="disabled" wire:target="update">
                                <span wire:loading.remove>Update</span>
                                <span wire:loading><i class="fas fa-spinner fa-spin"></i> Mengupdate...</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Modal Hapus --}}
        <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus Data</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        Anda yakin ingin menghapus user: <strong>{{ $deleteName ?? '' }}</strong>? Tindakan ini tidak dapat dibatalkan.
                    </div>
                    <div class="modal-footer justify-content-end">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-danger" wire:click="destroy()" wire:loading.attr="disabled">
                            <span wire:loading.remove>Ya, Hapus!</span>
                            <span wire:loading><i class="fas fa-spinner fa-spin"></i> Menghapus...</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>