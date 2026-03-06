{{-- Menggunakan wire:ignore.self agar Livewire tidak mengganggu animasi buka/tutup modal Bootstrap --}}
<div wire:ignore.self class="modal fade" id="edit-pemenuhan-pegawai" tabindex="-1" role="dialog"
    aria-labelledby="editPemenuhanPegawaiLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <form wire:submit.prevent="save">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="editPemenuhanPegawaiLabel">Edit Pemenuhan Pegawai</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div wire:loading.remove wire:target="loadModal">
                        @if ($uraianTugas)
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pns">PNS</label>
                                        <input type="number" class="form-control @error('pns') is-invalid @enderror"
                                            id="pns" wire:model.defer="pns">
                                        @error('pns')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="non_pns">Non-PNS</label>
                                        <input type="number"
                                            class="form-control @error('non_pns') is-invalid @enderror" id="non_pns"
                                            wire:model.defer="non_pns">
                                        @error('non_pns')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pppk">PPPK</label>
                                        <input type="number" class="form-control @error('pppk') is-invalid @enderror"
                                            id="pppk" wire:model.defer="pppk">
                                        @error('pppk')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cpns">CPNS</label>
                                        <input type="number" class="form-control @error('cpns') is-invalid @enderror"
                                            id="cpns" wire:model.defer="cpns">
                                        @error('cpns')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pemenuhan_pegawai">Pemenuhan Pegawai</label>
                                        <input type="number"
                                            class="form-control @error('pemenuhan_pegawai') is-invalid @enderror"
                                            id="pemenuhan_pegawai" wire:model.defer="pemenuhan_pegawai">
                                        @error('pemenuhan_pegawai')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="modal-footer justify-content-end">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">
                        <span wire:loading.remove wire:target="save">Simpan Perubahan</span>
                        <span wire:loading wire:target="save">Menyimpan...</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
