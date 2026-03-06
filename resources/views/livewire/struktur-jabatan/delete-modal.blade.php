<div wire:ignore.self class="modal fade" id="deleteJabatanModal" tabindex="-1" role="dialog"
    aria-labelledby="deleteJabatanModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteJabatanModalLabel">
                    <i class="fas fa-exclamation-triangle mr-2"></i> Konfirmasi Hapus Jabatan
                </h5>
                <button type="button" class="close text-white" wire:click="closeModal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! $message !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" wire:click="closeModal">Batal</button>
                
                <button type="button" wire:click="destroy" class="btn btn-danger" wire:loading.attr="disabled"
                    wire:target="destroy">
                    <span wire:loading.remove wire:target="destroy">
                        <i class="fas fa-trash-alt"></i> Ya, Hapus!
                    </span>
                    <span wire:loading wire:target="destroy">
                        <i class="fas fa-spinner fa-spin"></i> Menghapus...
                    </span>
                </button>
            </div>
        </div>
    </div>
</div>