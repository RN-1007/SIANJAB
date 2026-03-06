<div>
    <button type="button" data-toggle="modal" data-target="#modal-tambah" class="mt-2 btn btn-sm btn-primary">
        <i class="fas fa-plus"></i>
        Staf Utama
    </button>
    <div wire:ignore.self class="modal fade" id="modal-tambah" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form wire:submit.prevent="store">
                    <div class="modal-header">
                        <h4 class="modal-title">Data Master Staf Utama</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div wire:ignore class="form-group">
                            <label>PD</label>
                            <select id="select-skpd"
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
                                placeholder="Isi nomenklatur"></textarea>
                            @error('nomenklatur_jabatan_struktural')
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