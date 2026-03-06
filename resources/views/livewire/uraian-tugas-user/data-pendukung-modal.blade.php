<div wire:ignore.self class="modal fade" z-index="20" id="data-pendukung" role="dialog">
    <div class="modal-dialog">
        <form wire:submit="saveDataPendukung">
            <div class="modal-content">
                <div class="modal-header">
                    {{ $modalType === 'update' ? 'Edit' : 'Tambah' }}
                    {{ $targetColumn === 'data_pendukung_sebelumnya' ? 'Data Pendukung Sebelumnya' : 'Data Pendukung' }}
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Select Option -->
                    <div class="form-group">
                        <label for="inputType">Pilih Jenis Input</label>
                        <select class="form-control" id="inputType" wire:model.live="inputType">
                            <option value="" disabled>-- Pilih Input --</option>
                            <option value="link">Input Link</option>
                            <option value="file">Input File</option>
                        </select>
                    </div>

                    @if ($inputType === 'link')
                        <div class="form-group">
                            <label>Link Address</label>
                            <input type="text" class="form-control @error('link') is-invalid @enderror"
                                placeholder="https://example.com" wire:model="link">
                            @error('link')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    @elseif ($inputType === 'file')
                        <div class="form-group" x-data="{ filename: '' }">
                            @if ($existingFileName)
                                <div class="alert alert-info py-2">
                                    File saat ini: <strong>{{ $existingFileName }}</strong><br>
                                    <small>Unggah file baru untuk menggantinya.</small>
                                </div>
                            @endif

                            <label>File Input</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input @error('file') is-invalid @enderror"
                                    id="customFile" wire:model="file"
                                    @change="filename = $event.target.files[0] ? $event.target.files[0].name : ''">
                                <label class="custom-file-label" for="customFile"
                                    x-text="filename ? filename : 'Choose file'"></label>
                            </div>
                            @error('file')
                                <span class="text-danger d-block mt-1">{{ $message }}</span>
                            @enderror
                            <div wire:loading wire:target="file" class="text-primary mt-2">
                                <i class="fas fa-spinner fa-spin"></i> Sedang mengunggah...
                            </div>
                        </div>
                    @endif
                </div>
                <div class="modal-footer justify-content-end">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">
                        <span wire:loading.remove wire:target="saveDataPendukung">Save changes</span>
                        <span wire:loading wire:target="saveDataPendukung">Saving...</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
