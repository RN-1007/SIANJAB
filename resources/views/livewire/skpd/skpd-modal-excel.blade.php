<div wire:ignore.self class="modal fade" id="impor-excel">
    <div class="modal-dialog">
        <div class="modal-content">
            <form wire:submit="importExcel" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title">Import Data PD dari Excel</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="fileExcel">Pilih File Excel</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" accept=".xls,.xlsx"
                                    class="custom-file-input @error('fileExcel') is-invalid @enderror" id="fileExcel"
                                    wire:model="fileExcel">
                                <label class="custom-file-label" for="fileExcel">
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

                        @error('fileExcel')
                            <span class="text-danger mt-1">{{ $message }}</span>
                        @enderror

                        <span class="form-text text-lg text-muted mt-2">
                            Pastikan file berformat .xls atau .xlsx dan sesuai dengan template yang disediakan.
                        </span>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <div>
                        <a href="{{ asset('formats/format_import_skpd.xlsx') }}" target="_blank"
                            class="btn btn-success">
                            <i class="fas fa-download"></i> Unduh Format
                        </a>
                    </div>

                    <div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" wire:loading.attr="disabled"
                            wire:target="importExcel">
                            <span wire:loading.remove wire:target="importExcel">
                                <i class="fas fa-file-import"></i> Import
                            </span>
                            <span wire:loading wire:target="importExcel">
                                Memproses...
                            </span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>