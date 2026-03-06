<div>
    <button type="button" class="btn btn-sm btn-success ml-3" data-toggle="modal" data-target="#impor-excel">
        <i class="fas fa-file-import"></i> Import Excel
    </button>

    <div wire:ignore.self class="modal fade" id="impor-excel">
        <div class="modal-dialog">
            <div class="modal-content">
                <form wire:submit="importExcel" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h4 class="modal-title">Import Struktur Jabatan</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group" wire:ignore>
                            <label for="idPdImport">Pilih Perangkat Daerah (PD)</label>
                            <select wire:model.defer="idPd" id="idPdImport" class="form-control @error('idPd') is-invalid @enderror">
                                <option value="">-- Pilih PD --</option>
                                @foreach($perangkatDaerahs as $pd)
                                    <option value="{{ $pd->id }}">{{ $pd->nama_pd }}</option>
                                @endforeach
                            </select>
                            @error('idPd') <span class="text-danger mt-1">{{ $message }}</span> @enderror
                        </div>

                        @if($idPd)
                            <div class="form-group mt-3">
                                <!-- Label diubah -->
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
                        @else
                            <div class="callout callout-info mt-3">
                                <p class="mb-0">Silakan pilih Perangkat Daerah (PD) terlebih dahulu untuk melanjutkan.</p>
                            </div>
                        @endif
                        
                    </div>
                    <div class="modal-footer justify-content-between">
                        <div>
                            @if($idPd)
                                <a href="{{ asset('formats/format_import_struktur_jabatan.xlsx') }}" target="_blank"
                                    class="btn btn-success">
                                    <i class="fas fa-download"></i> Unduh Format
                                </a>
                            @endif
                        </div>

                        <div>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            
                            @if($idPd)
                                <button type="submit" class="btn btn-primary" wire:loading.attr="disabled"
                                    wire:target="importExcel, fileExcel, idPd">
                                    <span wire:loading.remove wire:target="importExcel, fileExcel, idPd">
                                        <i class="fas fa-file-import"></i> Import
                                    </span>
                                    <span wire:loading wire:target="importExcel, fileExcel, idPd">
                                        Memproses...
                                    </span>
                                </button>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

