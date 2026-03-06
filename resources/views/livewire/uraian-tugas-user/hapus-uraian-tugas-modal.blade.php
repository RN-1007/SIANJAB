<div class="modal fade" id="deleteUraianTugasModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
    aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold" id="deleteModalLabel">
                    <i class="fas fa-exclamation-triangle text-warning mr-2"></i> Konfirmasi Hapus
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus uraian tugas ini secara permanen?</p>
                <div class="alert alert-secondary">
                    <strong>Detail:</strong><br>
                    {{ $uraianTugasName ?? '...' }}
                </div>
                <p class="text-danger text-lg mt-3">
                    <small>Tindakan ini tidak dapat diurungkan dan akan menghapus semua file data pendukung yang
                        terkait.</small>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" wire:click="delete" wire:loading.attr="disabled">
                    <span wire:loading.remove wire:target="delete">
                        <i class="fas fa-trash-alt mr-1"></i> Ya, Hapus
                    </span>
                    <span wire:loading wire:target="delete">
                        <i class="fas fa-spinner fa-spin mr-1"></i> Menghapus...
                    </span>
                </button>
            </div>
        </div>
    </div>
</div>
