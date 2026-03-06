<div wire:ignore.self class="modal fade" id="staf-data-pendukung" tabindex="-1" role="dialog" data-backdrop="static"
    data-keyboard="false">
    <div class="modal-dialog">
        <form wire:submit.prevent="saveDataPendukung">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        {{ $modalType === 'update' ? 'Edit' : 'Tambah' }}
                        {{ $targetColumn === 'data_pendukung_sebelumnya' ? 'Data Pendukung Sebelumnya' : 'Data Pendukung' }}
                    </h5>
                    <button type="button" class="close" wire:click="closeModal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{-- Error General --}}
                    @error('general')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="form-group">
                        <label for="inputType">Pilih Jenis Input *</label>
                        <select class="form-control @error('inputType') is-invalid @enderror"
                            wire:model.live="inputType" required>
                            <option value="">-- Pilih Input --</option>
                            <option value="link">Input Link</option>
                            <option value="file">Input File</option>
                        </select>
                        @error('inputType')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    @if ($inputType === 'link')
                        <div class="form-group">
                            <label>Link Address *</label>
                            <input type="url" class="form-control @error('link') is-invalid @enderror"
                                placeholder="https://example.com" wire:model="link" required>
                            @error('link')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    @elseif ($inputType === 'file')
                        <div class="form-group">
                            @if ($existingFileName)
                                <div class="alert alert-info">
                                    File saat ini: <strong>{{ $existingFileName }}</strong>
                                </div>
                            @endif

                            <label>File Input * (PDF, JPG, PNG, DOC, DOCX, XLS, XLSX, PPT, PPTX - Max 10MB)</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input @error('file') is-invalid @enderror"
                                    wire:model="file" id="customFile"
                                    accept=".pdf,.jpg,.jpeg,.png,.doc,.docx,.xls,.xlsx,.ppt,.pptx"
                                    wire:loading.attr="disabled">
                                <label class="custom-file-label" for="customFile">
                                    @if ($file)
                                        {{ $file->getClientOriginalName() }}
                                    @else
                                        Pilih file...
                                    @endif
                                </label>
                            </div>

                            {{-- Loading State saat Upload --}}
                            <div wire:loading wire:target="file" class="mt-2">
                                <div class="d-flex align-items-center text-primary">
                                    <div class="spinner-border spinner-border-sm mr-2" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                    <span>Mengupload file...</span>
                                </div>
                            </div>

                            @error('file')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                            @if ($file)
                                <div class="mt-2 text-success">
                                    <i class="fas fa-check-circle"></i>
                                    File dipilih: {{ $file->getClientOriginalName() }}
                                    ({{ number_format($file->getSize() / 1024, 2) }} KB)
                                </div>
                            @endif
                        </div>
                    @endif
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal"
                        wire:loading.attr="disabled">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled"
                        wire:target="saveDataPendukung" @if (empty($inputType)) disabled @endif>
                        <span wire:loading.remove wire:target="saveDataPendukung">
                            <i class="fas fa-save"></i> Simpan
                        </span>
                        <span wire:loading wire:target="saveDataPendukung">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Menyimpan...
                        </span>
                    </button>
                </div>
            </div>
        </form>
    </div>

    {{-- CSS untuk loading states --}}
    <style>
        .custom-file-input:disabled+.custom-file-label {
            background-color: #e9ecef;
            opacity: 0.65;
            cursor: not-allowed;
        }

        /* Loading animation */
        @keyframes fadeInOut {
            0% {
                opacity: 0.5;
            }

            50% {
                opacity: 1;
            }

            100% {
                opacity: 0.5;
            }
        }

        .loading-state {
            animation: fadeInOut 1.5s ease-in-out infinite;
        }

        /* Disabled button styling */
        .btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Update label saat file dipilih
            $(document).on('change', '.custom-file-input', function(e) {
                var fileName = e.target.files[0]?.name ?? 'Pilih file...';
                var nextSibling = e.target.nextElementSibling;
                if (nextSibling) {
                    nextSibling.innerText = fileName;
                }
            });

            // Reset form ketika modal ditutup
            $('#staf-data-pendukung').on('hidden.bs.modal', function() {
                // Reset custom file label
                $('.custom-file-label').text('Pilih file...');

                // Dispatch ke Livewire untuk reset
                if (window.Livewire) {
                    Livewire.dispatch('modalClosed');
                }
            });

            // Handle modal events
            window.addEventListener('open-staf-data-pendukung-modal', event => {
                $('#staf-data-pendukung').modal('show');
            });

            window.addEventListener('close-staf-data-pendukung-modal', event => {
                $('#staf-data-pendukung').modal('hide');

                // Force remove backdrop and modal-open class
                setTimeout(() => {
                    $('.modal-backdrop').remove();
                    $('body').removeClass('modal-open');
                }, 150);
            });

            // Success/Error notifications
            window.addEventListener('show-success', event => {
                // Implementasi notifikasi sukses (bisa pakai SweetAlert, Toastr, dll)
                alert('Success: ' + event.detail.message);
            });

            window.addEventListener('show-error', event => {
                // Implementasi notifikasi error
                alert('Error: ' + event.detail.message);
            });
        });
    </script>

</div>
