<div>
    <table class="table table-bordered table-striped table-sm table-lg-text mt-3" id="example1">
        <thead>
            <tr>
                <th class="text-center" style="width: 5%">No</th>
                <th class="text-center">Kode Tusi</th>
                <th class="text-center">Tusi</th>
                <th class="text-center">Nama Jabatan Permenpan 45</th>
                <th class="text-center">Nama Jabatan Permenpan 41</th>
                <th class="text-center" style="width: 8%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tusis as $item)
                <tr>
                    <td class="text-center font-weight-bold text-md">{{ $loop->iteration }}.</td>
                    <td class="text-md">{{ $item->code_tusi }}</td>
                    <td class="text-md">{{ $item->tusi }}</td>
                    <td class="text-md">{{ $item->nama_jabatan_permempan_45 }}</td>
                    <td class="text-md">{{ $item->nama_jabatan_permempan_41 }}</td>
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
                    <td colspan="6" class="text-center">Data tidak ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Modal Edit --}}
    <div wire:ignore.self class="modal fade" id="modal-edit" tabindex="-1" role="dialog"
        aria-labelledby="modal-edit-label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form wire:submit.prevent="update">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modal-edit-label">Edit Data Tusi</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            wire:click="resetInputFields">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" wire:model="id_tusi">

                        {{-- Input untuk Code Tusi --}}
                        <div class="form-group">
                            <label>Code Tusi</label>
                            <input type="text" wire:model="code_tusi"
                                class="form-control @error('code_tusi') is-invalid @enderror"
                                placeholder="Edit Code Tusi">
                            @error('code_tusi')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Textarea untuk Tusi --}}
                        <div class="form-group">
                            <label>Tusi</label>
                            <textarea wire:model="tusi" class="form-control @error('tusi') is-invalid @enderror" rows="3"
                                placeholder="Edit Tusi"></textarea>
                            @error('tusi')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Input untuk Permenpan 45 --}}
                        <div class="form-group">
                            <label>Nama Jabatan Permenpan 45</label>
                            <input type="text" wire:model="nama_jabatan_permempan_45"
                                class="form-control @error('nama_jabatan_permempan_45') is-invalid @enderror"
                                placeholder="Edit Nama Jabatan Permenpan 45">
                            @error('nama_jabatan_permempan_45')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Input untuk Permenpan 41 --}}
                        <div class="form-group">
                            <label>Nama Jabatan Permenpan 41</label>
                            <input type="text" wire:model="nama_jabatan_permempan_41"
                                class="form-control @error('nama_jabatan_permempan_41') is-invalid @enderror"
                                placeholder="Edit Nama Jabatan Permenpan 41">
                            @error('nama_jabatan_permempan_41')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer justify-content-end">
                        <button type="button" class="btn btn-default" data-dismiss="modal"
                            wire:click="resetInputFields">Close</button>
                        <button type="submit" class="btn btn-primary" wire:loading.attr="disabled"
                            wire:target="update">
                            <span wire:loading wire:target="update">
                                <i class="fas fa-spinner fa-spin"></i> Updating...
                            </span>
                            <span wire:loading.remove wire:target="update">
                                Update
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Delete --}}
    <div wire:ignore.self class="modal fade" id="modal-delete" tabindex="-1" role="dialog"
        aria-labelledby="modal-delete-label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal-delete-label">Konfirmasi Hapus Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Anda yakin ingin menghapus data: <strong>{{ $deleteName }}</strong>? Tindakan ini tidak dapat
                    dibatalkan.
                </div>
                <div class="modal-footer justify-content-end">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" wire:click="destroy()"
                        wire:loading.attr="disabled" wire:target="destroy">
                        <span wire:loading.remove wire:target="destroy">
                            Ya, Hapus!
                        </span>
                        <span wire:loading wire:target="destroy">
                            <i class="fas fa-spinner fa-spin"></i> Menghapus...
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
