<div>
    <button type="button" data-toggle="modal" data-target="#modal-tambah-tusi" class="mt-2 btn btn-sm btn-primary">
        <i class="fas fa-plus"></i>
        Tusi
    </button>
    <div wire:ignore.self class="modal fade" id="modal-tambah-tusi">
        <div class="modal-dialog">
            <div class="modal-content">
                <form wire:submit.prevent="store">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Data Tusi</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Kode Tusi</label>
                            <input type="number" wire:model="code_tusi"
                                class="form-control @error('code_tusi') is-invalid @enderror" placeholder="Kode Tusi">
                            @error('code_tusi')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Tusi</label>
                            <textarea wire:model="tusi" class="form-control @error('tusi') is-invalid @enderror" rows="3"
                                placeholder="Tambah Tusi"></textarea>
                            @error('tusi')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Nama Jabatan Permenpan 45</label>
                            <input type="text" wire:model="nama_jabatan_permempan_45"
                                class="form-control @error('nama_jabatan_permempan_45') is-invalid @enderror"
                                placeholder="Nama Jabatan Permenpan 45">
                            @error('nama_jabatan_permempan_45')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Nama Jabatan Permenpan 41</label>
                            <input type="text" wire:model="nama_jabatan_permempan_41"
                                class="form-control @error('nama_jabatan_permempan_41') is-invalid @enderror"
                                placeholder="Nama Jabatan Permenpan 41">
                            @error('nama_jabatan_permempan_41')
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
