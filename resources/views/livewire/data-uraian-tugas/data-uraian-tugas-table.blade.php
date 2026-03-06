<div>
    <table class="table table-bordered table-striped table-sm" id="example1">
        <thead>
            <tr>
                <th class="text-center" style="width:5%">No</th>
                <th class="text-center">Nama Jabatan</th>
                <th class="text-center">Jumlah PNS</th>
                <th class="text-center">Jumlah CPNS</th>
                <th class="text-center">Jumlah PPPK</th>
                <th class="text-center">Jumlah NON PNS</th>
                <th class="text-center">Jumlah Eksisting</th>
                <th class="text-center">Jumlah Maksimal</th>
                <th class="text-center">Jumlah Blm Terpenuhi</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($uraianTugas as $item)
                <tr>
                    <td class="text-center font-weight-bold text-md">{{ $loop->iteration }}.</td>
                    <td class="text-md font-weight-bold">{{ $item->user?->jabatan ?? 'User Tidak Ditemukan' }}</td>
                    <td class="text-center text-md">{{ $item->pns }}</td>
                    <td class="text-center text-md">{{ $item->cpns }}</td>
                    <td class="text-center text-md">{{ $item->pppk }}</td>
                    <td class="text-center text-md">{{ $item->non_pns }}</td>
                    <td class="text-center text-md">{{ $item->jumlah_eksisting }}</td>
                    <td class="text-center text-md">{{ $item->pemenuhan_pegawai }}</td>
                    <td class="text-center text-md font-weight-bold">
                        {{ $item->pemenuhan_pegawai - $item->jumlah_eksisting }}</td>
                    <td class="text-center">
                        <div class="btn-group" role="group">
                            <button wire:click="edit({{ $item->id }})" class="btn btn-sm btn-info"
                                title="Edit Data">
                                <i class="fas fa-pen"></i>
                            </button>
                            <button wire:click="confirmDelete({{ $item->id }})" class="btn btn-sm btn-danger"
                                title="Hapus Data">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" class="text-center">Data tidak ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- MODAL EDIT --}}
    <div wire:ignore.self class="modal fade" id="modal-edit-uraian-tugas">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form wire:submit.prevent="update">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Data Uraian Tugas Staf</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            wire:click="resetInputFields">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        
                        {{-- PERBAIKAN: Hapus 'wire:ignore' dari sini --}}
                        <div class="form-group">
                            <label>Nama Jabatan (User)</label>
                            {{-- PERBAIKAN: Hapus 'wire:model.live', pastikan ID ada --}}
                            <select id="select-id-user-edit" class="form-control @error('id_user') is-invalid @enderror" style="width: 100%;">
                                <option value="">-- Pilih Jabatan --</option>
                                {{-- Daftar ini sekarang akan di-render ulang oleh Livewire --}}
                                @if(!empty($availableUsers))
                                    @foreach ($availableUsers as $user)
                                        <option value="{{ is_array($user) ? $user['id'] : $user->id }}">
                                            {{ is_array($user) ? $user['jabatan'] : $user->jabatan }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @error('id_user')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Jumlah PNS</label>
                                    <input type="number" wire:model="pns"
                                        class="form-control @error('pns') is-invalid @enderror">
                                    @error('pns')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Jumlah CPNS</label>
                                    <input type="number" wire:model="cpns"
                                        class="form-control @error('cpns') is-invalid @enderror">
                                    @error('cpns')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Jumlah PPPK</label>
                                    <input type="number" wire:model="pppk"
                                        class="form-control @error('pppk') is-invalid @enderror">
                                    @error('pppk')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Jumlah NON PNS</label>
                                    <input type="number" wire:model="non_pns"
                                        class="form-control @error('non_pns') is-invalid @enderror">
                                    @error('non_pns')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kelas Jabatan</label>
                                    <input type="number" wire:model="kelas_jabatan"
                                        class="form-control @error('kelas_jabatan') is-invalid @enderror">
                                    @error('kelas_jabatan')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Jumlah Maksimal (Pemenuhan Pegawai)</label>
                                    <input type="number" wire:model="pemenuhan_pegawai"
                                        class="form-control @error('pemenuhan_pegawai') is-invalid @enderror">
                                    @error('pemenuhan_pegawai')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-end">
                        <button type="button" class="btn btn-default" data-dismiss="modal"
                            wire:click="resetInputFields">Batal</button>
                        <button type="submit" class="btn btn-primary" wire:loading.attr="disabled"
                            wire:target="update">
                            <span wire:loading.remove wire:target="update">Update</span>
                            <span wire:loading wire:target="update">Updating...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="modal-delete">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Konfirmasi Hapus Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Anda yakin ingin menghapus data untuk: <strong>{{ $deleteName }}</strong>?
                </div>
                <div class="modal-footer justify-content-end">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" wire:click="destroy()">Ya, Hapus!</button>
                </div>
            </div>
        </div>
    </div>
</div>