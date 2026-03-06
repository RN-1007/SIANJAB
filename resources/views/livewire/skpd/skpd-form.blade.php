<div>
    <button type="button" data-toggle="modal" data-target="#modal-tambah" class="mt-2 btn btn-sm btn-primary">
        <i class="fas fa-plus"></i>
        PD
    </button>
    {{-- Modal Tambah data --}}
    <div wire:ignore.self class="modal fade" id="modal-tambah">
        <div class="modal-dialog">
            <div class="modal-content">
                <form wire:submit="store">
                    <div class="modal-header">
                        <h4 class="modal-title">Data Master PD</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama PD</label>
                            <textarea wire:model="nama_pd" class="form-control @error('nama_pd') is-invalid @enderror" rows="3"
                                placeholder="Tambah Nama PD"></textarea>
                            @error('nama_pd')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer justify-content-end">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" wire:loading.attr="disabled" wire:target="store">
                            <span wire:loading.remove wire:target="store">Save</span>
                            <span wire:loading wire:target="store">Saving...</span>
                        </button>
                    </div>
                </form>
            </div>
            </div>
        </div>
</div>