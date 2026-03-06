<div wire:ignore.self class="modal fade" id="modal-import-tusi">
    <div class="modal-dialog">
        <div class="modal-content">
            <form wire:submit="importExcel" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title">Import Data Uraian Tugas & Tusi</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="fileExcelTusi">Pilih File Excel</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input @error('fileExcel') is-invalid @enderror"
                                    id="fileExcelTusi" wire:model="fileExcel" accept=".xls,.xlsx">
                                <label class="custom-file-label" for="fileExcelTusi">
                                    @if ($fileExcel)
                                        {{ $fileExcel->getClientOriginalName() }}
                                    @else
                                        Pilih file...
                                    @endif
                                </label>
                            </div>
                        </div>
                        <div wire:loading wire:target="fileExcel" class="mt-2 text-primary">
                            Mengunggah file...
                        </div>
                        <span class="form-text text-lg text-muted mt-2">
                            Pastikan file berformat .xls atau .xlsx dan sesuai dengan template yang disediakan.
                        </span>
                        @error('fileExcel')
                            <span class="text-danger mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <div>
                        <a href="{{ asset('formats/format_import_setting_tusi.xlsx') }}" target="_blank"
                            class="btn btn-success">
                            <i class="fas fa-download"></i> Unduh Format
                        </a>
                    </div>
                    <div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                            <span wire:loading.remove>
                                <i class="fas fa-file-import"></i> Import
                            </span>
                            <span wire:loading>Memproses...</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
