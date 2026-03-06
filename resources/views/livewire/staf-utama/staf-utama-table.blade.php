<div>
    <table class="table table-bordered table-striped table-sm" id="example1">
        <thead>
            <tr>
                <th class="text-center" style="width:5%">No</th>
                <th class="text-center" style="width:30%">PD</th>
                <th class="text-center" style="width:55%">Nomenklatur Jabatan Struktural</th>
                <th class="text-center" style="width:10%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($items as $index => $item)
                <tr>
                    <td class="text-center font-weight-bold text-md">{{ $loop->iteration }}.</td>
                    <td class="text-md font-weight-bold">{{ $item->skpd->nama_pd ?? '-' }}</td>
                    <td class="text-md font-weight-bold">{{ $item->nomenklatur_jabatan_struktural }}</td>
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
                    <td colspan="4" class="text-center">Data tidak ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div wire:ignore.self class="modal fade" id="modal-edit" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form wire:submit.prevent="update">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modal-edit-label">Edit Data Master Staf Utama</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            wire:click="resetInputFields">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" wire:model="id_staf_utama">
                        <div wire:ignore class="form-group">
                            <label>PD</label>
                            <select id="select-skpd-edit"
                                class="form-control select2bs4 @error('id_skpd') is-invalid @enderror"
                                style="width: 100%;">
                                <option></option> 
                                @foreach ($skpds as $skpd)
                                    <option value="{{ $skpd->id }}">{{ $skpd->nama_pd }}</option>
                                @endforeach
                            </select>
                            @error('id_skpd')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Nomenklatur Jabatan Struktural</label>
                            <textarea wire:model="nomenklatur_jabatan_struktural"
                                class="form-control @error('nomenklatur_jabatan_struktural') is-invalid @enderror" rows="3"
                                placeholder="Edit nomenklatur"></textarea>
                            @error('nomenklatur_jabatan_struktural')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer justify-content-end">
                        <button type="button" class="btn btn-default" data-dismiss="modal"
                            wire:click="resetInputFields">Close</button>
                        <button type="submit" class="btn btn-primary" wire:loading.attr="disabled"
                            wire:target="update">
                            <span wire:loading wire:target="update"><i class="fas fa-spinner fa-spin"></i>
                                Updating...</span>
                            <span wire:loading.remove wire:target="update">Update</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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
                    <button type="button" class="btn btn-danger" wire:click="destroy()" wire:loading.attr="disabled"
                        wire:target="destroy">
                        <span wire:loading.remove wire:target="destroy">Ya, Hapus!</span>
                        <span wire:loading wire:target="destroy"><i class="fas fa-spinner fa-spin"></i>
                            Menghapus...</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>