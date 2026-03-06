<div>
    <!-- Tombol Submit untuk checkbox yang dipilih -->
    @if ($dataUraianTugasValid->count() > 0)
        @if (Auth::user()->role === 'admin')
            <div class="mb-3">
                <button wire:click="submitSelectedItems" class="btn btn-success btn-sm" wire:loading.attr="disabled"
                    wire:target="submitSelectedItems" @if (empty($selectedItems)) disabled @endif>
                    <span wire:loading.remove wire:target="submitSelectedItems">
                        <i class="fas fa-check mr-2"></i>
                        Submit Data Terpilih ({{ count($selectedItems) }})
                    </span>
                    <span wire:loading wire:target="submitSelectedItems">
                        <i class="fas fa-spinner fa-spin mr-2"></i>
                        Memproses...
                    </span>
                </button>
            </div>
        @endif

        <div class="table-responsive">
            <table id="example2" class="table table-bordered table-striped"
                style="width: 100%; min-width: 1800px; table-layout: fixed;">
                <colgroup>
                    <col style="width: 3%;"> <!-- No -->
                    <col style="width: 15%;"> <!-- Tugas dan Fungsi -->
                    <col style="width: 17%;"> <!-- Uraian Tugas -->
                    <col style="width: 5%;"> <!-- ABK Ideal -->
                    <col style="width: 5%;"> <!-- ABK Berlebih -->
                    <col style="width: 9%;"> <!-- Nama Jabatan Permenpan 45 -->
                    <col style="width: 9%;"> <!-- Nama Jabatan Permenpan 41 -->
                    <col style="width: 7%;"> <!-- Kategori Jabatan -->
                    <col style="width: 9%;"> <!-- Data Pendukung Sebelumnya -->
                    <col style="width: 7%;"> <!-- Data Pendukung -->
                    <col style="width: 7%;"> <!-- Catatan Mahasiswa -->
                    <col style="width: 5%;"> <!-- Checkbox -->
                    <col style="width: 9%;"> <!-- Action -->
                </colgroup>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tugas dan Fungsi</th>
                        <th>Uraian Tugas Staf</th>
                        <th>ABK Ideal</th>
                        <th>ABK Berlebih</th>
                        <th>Nama Jabatan Permenpan 45</th>
                        <th>Nama Jabatan Permenpan 41</th>
                        <th>Kategori Jabatan</th>
                        <th>Data Pendukung Sebelumnya</th>
                        <th>Data Pendukung</th>
                        <th>Catatan Mahasiswa</th>
                        <th class="text-center">
                            <div class="d-flex flex-column align-items-center">
                                <span class="mb-1">Checkbox</span>
                                @if (Auth::user()->role === 'admin')
                                    <input type="checkbox" wire:model.live="selectAll" class="item-checkbox"
                                        id="selectAll">
                                @endif
                            </div>
                        </th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $tusiCounter = 0;
                        $subTugasCounter = 0;
                        $previousTusiId = null;
                    @endphp

                    @forelse ($dataUraianTugasValid as $item)
                        @php $currentTusiId = optional(optional($item->uraianTugas)->tusi)->id; @endphp
                        <tr wire:key="item-{{ $item->id }}"
                            class="{{ in_array((string) $item->id, $selectedItems) ? 'table-warning' : '' }}">
                            @if ($currentTusiId != $previousTusiId)
                                @php
                                    $tusiCounter++;
                                    $subTugasCounter = 1;
                                    $previousTusiId = $currentTusiId;
                                @endphp
                                <td class="text-center">{{ $tusiCounter }}.</td>
                                <td>{{ optional(optional($item->uraianTugas)->tusi)->tusi ?? '' }}</td>
                            @else
                                @php
                                    $subTugasCounter++;
                                @endphp
                                <td class="text-center"></td>
                                <td></td>
                            @endif

                            <td>
                                <b
                                    @if (!$item->rincianTugas) class="text-danger" @endif>[{{ $tusiCounter }}.{{ $subTugasCounter }}]</b>
                                @if ($item->rincianTugas)
                                    <b>Isian Di Rubah
                                        {{ optional($item->rincianTugas->updated_at)->format('Y-d-m') }}</b><br>
                                @else
                                    <b class="text-danger">Belum Ada Isi Rincian</b><br>
                                @endif
                                <span>{{ $item->uraian_tugas_staf ?? '' }}</span>
                                {{-- TOMBOL RINCIAN TUGAS DENGAN ICON BERKAS DAN LOADING --}}
                                <button wire:click="showRincianTugas({{ $item->id }})"
                                    class="btn btn-sm btn-outline-info ms-2 {{ $loadingRincianId == $item->id ? 'disabled' : '' }}"
                                    title="Lihat Rincian Tugas" wire:loading.attr="disabled"
                                    wire:target="showRincianTugas({{ $item->id }})">
                                    <span wire:loading.remove wire:target="showRincianTugas({{ $item->id }})">
                                        <i class="fas fa-folder-open"></i>
                                    </span>
                                    <span wire:loading wire:target="showRincianTugas({{ $item->id }})">
                                        <i class="fas fa-spinner fa-spin"></i>
                                    </span>
                                </button>
                            </td>
                            <td class="text-center">{{ $item->abk_ideal ?? '' }}</td>
                            <td class="text-center">{{ $item->abk_berlebih ?? '' }}</td>
                            <td>{{ $item->tusi_nama_jabatan_permempan_45 ?? '' }}</td>
                            <td>{{ $item->tusi_nama_jabatan_permempan_41 ?? '' }}</td>
                            <td>{{ $item->kategori_jabatan ?? '' }}</td>
                            <td class="text-center">
                                @if (Auth::user()->role === 'admin')
                                    @if ($item->data_pendukung_sebelumnya)
                                        @if ($item->type_data_pendukung_sebelumnya == 'link')
                                            <a href="{{ $item->data_pendukung_sebelumnya }}" target="_blank"
                                                class="btn btn-sm btn-info mb-1" title="Lihat Tautan"><i
                                                    class="fas fa-eye"></i></a>
                                        @else
                                            <a href="{{ Storage::url($item->data_pendukung_sebelumnya) }}"
                                                target="_blank" class="btn btn-sm btn-primary mb-1"
                                                title="Unduh File"><i class="fas fa-download"></i></a>
                                        @endif
                                        <br>
                                        <button
                                            wire:click="openDataPendukungModal({{ $item->id }}, 'update', 'data_pendukung_sebelumnya')"
                                            class="btn btn-sm btn-warning {{ $loadingModalId == $item->id && $loadingType == 'data_pendukung_sebelumnya' ? 'disabled' : '' }}"
                                            title="Edit Data Pendukung Sebelumnya" wire:loading.attr="disabled"
                                            wire:target="openDataPendukungModal({{ $item->id }}, 'update', 'data_pendukung_sebelumnya')">
                                            <span wire:loading.remove
                                                wire:target="openDataPendukungModal({{ $item->id }}, 'update', 'data_pendukung_sebelumnya')">
                                                <i class="fas fa-edit"></i>
                                            </span>
                                            <span wire:loading
                                                wire:target="openDataPendukungModal({{ $item->id }}, 'update', 'data_pendukung_sebelumnya')">
                                                <i class="fas fa-spinner fa-spin"></i>
                                            </span>
                                        </button>
                                    @else
                                        <button
                                            wire:click="openDataPendukungModal({{ $item->id }}, 'upload', 'data_pendukung_sebelumnya')"
                                            class="btn btn-sm btn-success {{ $loadingModalId == $item->id && $loadingType == 'data_pendukung_sebelumnya' ? 'disabled' : '' }}"
                                            title="Tambah Data Pendukung Sebelumnya" wire:loading.attr="disabled"
                                            wire:target="openDataPendukungModal({{ $item->id }}, 'upload', 'data_pendukung_sebelumnya')">
                                            <span wire:loading.remove
                                                wire:target="openDataPendukungModal({{ $item->id }}, 'upload', 'data_pendukung_sebelumnya')">
                                                <i class="fas fa-plus"></i>
                                            </span>
                                            <span wire:loading
                                                wire:target="openDataPendukungModal({{ $item->id }}, 'upload', 'data_pendukung_sebelumnya')">
                                                <i class="fas fa-spinner fa-spin"></i>
                                            </span>
                                        </button>
                                    @endif
                                @endif
                            </td>
                            <td class="text-center">
                                {{-- Data Pendukung saat ini --}}
                                @if (Auth::user()->role === 'admin')
                                    @if ($item->data_pendukung)
                                        @if ($item->type_data_pendukung == 'link')
                                            <a href="{{ $item->data_pendukung }}" target="_blank"
                                                class="btn btn-sm btn-info mb-1" title="Lihat Tautan"><i
                                                    class="fas fa-eye"></i></a>
                                        @else
                                            <a href="{{ Storage::url($item->data_pendukung) }}" target="_blank"
                                                class="btn btn-sm btn-primary mb-1" title="Unduh File"><i
                                                    class="fas fa-download"></i></a>
                                        @endif
                                        <br>
                                        <button
                                            wire:click="openDataPendukungModal({{ $item->id }}, 'update', 'data_pendukung')"
                                            class="btn btn-sm btn-warning {{ $loadingModalId == $item->id && $loadingType == 'data_pendukung' ? 'disabled' : '' }}"
                                            title="Edit Data Pendukung" wire:loading.attr="disabled"
                                            wire:target="openDataPendukungModal({{ $item->id }}, 'update', 'data_pendukung')">
                                            <span wire:loading.remove
                                                wire:target="openDataPendukungModal({{ $item->id }}, 'update', 'data_pendukung')">
                                                <i class="fas fa-edit"></i>
                                            </span>
                                            <span wire:loading
                                                wire:target="openDataPendukungModal({{ $item->id }}, 'update', 'data_pendukung')">
                                                <i class="fas fa-spinner fa-spin"></i>
                                            </span>
                                        </button>
                                    @else
                                        <button
                                            wire:click="openDataPendukungModal({{ $item->id }}, 'upload', 'data_pendukung')"
                                            class="btn btn-sm btn-success {{ $loadingModalId == $item->id && $loadingType == 'data_pendukung' ? 'disabled' : '' }}"
                                            title="Tambah Data Pendukung" wire:loading.attr="disabled"
                                            wire:target="openDataPendukungModal({{ $item->id }}, 'upload', 'data_pendukung')">
                                            <span wire:loading.remove
                                                wire:target="openDataPendukungModal({{ $item->id }}, 'upload', 'data_pendukung')">
                                                <i class="fas fa-plus"></i>
                                            </span>
                                            <span wire:loading
                                                wire:target="openDataPendukungModal({{ $item->id }}, 'upload', 'data_pendukung')">
                                                <i class="fas fa-spinner fa-spin"></i>
                                            </span>
                                        </button>
                                    @endif
                                @endif
                            </td>
                            <td class="text-center">
                                @if ($item->catatan_mahasiswa)
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="blue" style="width: 40px; height: 40px;">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
                                    </svg>
                                @endif
                            </td>
                            <td class="text-center">
                                @if (Auth::user()->role === 'admin')
                                    <div class="d-flex flex-column align-items-center">
                                        <div class="mb-2">
                                            <i class="fas fa-exclamation-triangle text-warning"
                                                style="font-size: 20px;" title="Belum Lengkap"></i>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox"
                                                class="item-checkbox form-check-input child-checkbox"
                                                wire:model.live="selectedItems" value="{{ $item->id }}"
                                                id="checkbox_{{ $item->id }}">
                                        </div>
                                    </div>
                                @endif
                            </td>
                            <td class="text-center">
                                @if (Auth::user()->role === 'admin')
                                    <div class="d-inline-flex flex-column" role="group"
                                        aria-label="Action Buttons">
                                        <button wire:click="edit2({{ $item->id }})" wire:loading.attr="disabled"
                                            wire:target="edit2({{ $item->id }})"
                                            class="btn btn-sm btn-info mb-2 {{ $loadingEditId == $item->id ? 'disabled' : '' }}"
                                            title="Edit Data">
                                            <span wire:loading.remove wire:target="edit2({{ $item->id }})"><i
                                                    class="fas fa-edit"></i></span>
                                            <span wire:loading wire:target="edit2({{ $item->id }})"><i
                                                    class="fas fa-spinner fa-spin"></i></span>
                                        </button>
                                        <button wire:click="confirmDelete2({{ $item->id }})"
                                            wire:loading.attr="disabled"
                                            wire:target="confirmDelete2({{ $item->id }})"
                                            class="btn btn-sm btn-danger {{ $loadingDeleteId == $item->id ? 'disabled' : '' }}"
                                            title="Hapus Data">
                                            <span wire:loading.remove
                                                wire:target="confirmDelete2({{ $item->id }})"><i
                                                    class="fas fa-trash"></i></span>
                                            <span wire:loading wire:target="confirmDelete2({{ $item->id }})"><i
                                                    class="fas fa-spinner fa-spin"></i></span>
                                        </button>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="13" class="text-center py-4">
                                <div class="text-muted">
                                    <i class="fas fa-inbox fa-3x mb-3"></i>
                                    <h5>Tidak ada data yang belum lengkap</h5>
                                    <p>Semua data uraian tugas staf sudah lengkap.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    @else
        <div class="text-center py-4">
            <div class="text-muted">
                <i class="fas fa-inbox fa-3x mb-3"></i>
                <h5>Tidak ada data yang belum lengkap</h5>
                <p>Semua data uraian tugas staf sudah lengkap.</p>
            </div>
        </div>
    @endif

    <!-- Modal Edit -->
    <div wire:ignore.self class="modal fade" id="editModal2" tabindex="-1" aria-labelledby="editModalLabel2"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form wire:submit.prevent="update2">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Data Tugas Staf (Belum Lengkap)</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            wire:click="resetInputFields2">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @if ($selectedId)
                            <div class="form-group">
                                <label>Uraian Tugas</label>
                                <textarea wire:model.defer="form2.uraian_tugas_staf"
                                    class="form-control @error('form2.uraian_tugas_staf') is-invalid @enderror" rows="3"></textarea>
                                @error('form2.uraian_tugas_staf')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <hr>
                            <div class="form-group">
                                <label>Hasil Kerja</label>
                                <input type="text" wire:model.defer="form2.hasil_kerja"
                                    class="form-control @error('form2.hasil_kerja') is-invalid @enderror">
                                @error('form2.hasil_kerja')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Satuan Hasil</label>
                                <input type="text" wire:model.defer="form2.satuan_hasil"
                                    class="form-control @error('form2.satuan_hasil') is-invalid @enderror">
                                @error('form2.satuan_hasil')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Target</label>
                                <input type="number" wire:model.defer="form2.target"
                                    class="form-control @error('form2.target') is-invalid @enderror">
                                @error('form2.target')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Frekuensi / Shift</label>
                                <select class="form-control @error('form2.frekuensi') is-invalid @enderror"
                                    wire:model.defer="form2.frekuensi">
                                    <option value="">-- Pilih Frekuensi --</option>
                                    <option value="235">5 Hari Kerja(235)</option>
                                    <option value="1">Tahunan (1)</option>
                                    <option value="2">Semesteran (2)</option>
                                    <option value="3">Caturwulanan (3)</option>
                                    <option value="4">Triwulanan (4)</option>
                                    <option value="6">Dwi bulan (6)</option>
                                    <option value="12">Bulanan (12)</option>
                                    <option value="52">Mingguan (52)</option>
                                    <option value="287">6 Hari Kerja (287)</option>
                                    <option value="365">Setiap Hari (365)</option>
                                </select>
                                @error('form2.frekuensi')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Waktu Penyelesaian (menit)</label>
                                <input type="number" wire:model.defer="form2.waktu_penyelesaian"
                                    class="form-control @error('form2.waktu_penyelesaian') is-invalid @enderror">
                                <span class="text-danger font-weight-bold font-italic">*Maksimal waktu diisi 330</span>
                                @error('form2.waktu_penyelesaian')
                                    <br><span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        @else
                            <div class="d-flex justify-content-center">
                                <div class="spinner-border" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"
                            wire:click="resetInputFields2">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Delete Confirmation -->
    <div wire:ignore.self class="modal fade" id="deleteConfirmModal2" tabindex="-1"
        aria-labelledby="deleteConfirmLabel2" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        wire:click="resetDeleteState2">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus data <strong>{{ $deleteUraianTugasStaf2 ?? '' }}</strong>?
                    Tindakan ini tidak dapat dibatalkan.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        wire:click="resetDeleteState2">Batal</button>
                    <button type="button" wire:click="destroy2" class="btn btn-danger">Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Rincian Tugas -->
    <div wire:ignore.self class="modal fade" id="rincianTugasModal2" tabindex="-1"
        aria-labelledby="rincianTugasModal2Label" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-gradient-info text-white">
                    <h5 class="modal-title" id="rincianTugasModal2Label">
                        <i class="fas fa-clipboard-list mr-2"></i>
                        Detail Rincian Tugas Staf
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if ($rincianTugas)
                        {{-- Informasi Uraian Tugas --}}
                        <div class="alert alert-info mb-4">
                            <h6 class="alert-heading">
                                <i class="fas fa-info-circle mr-2"></i>Informasi Uraian Tugas
                            </h6>
                            <p class="mb-0">
                                <strong>ID Uraian Tugas:</strong> {{ $selectedRincianId }}<br>
                                <strong>Terakhir Diperbarui:</strong>
                                {{ $rincianTugas->updated_at ? $rincianTugas->updated_at->format('d/m/Y H:i:s') : '-' }}
                            </p>
                        </div>

                        {{-- Detail Rincian dalam Card --}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card shadow-sm mb-3">
                                    <div class="card-body">
                                        <h6 class="card-title text-primary">
                                            <i class="fas fa-bullseye mr-2"></i>Hasil Kerja
                                        </h6>
                                        <p class="card-text">{{ $rincianTugas->hasil_kerja ?? '-' }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card shadow-sm mb-3">
                                    <div class="card-body">
                                        <h6 class="card-title text-success">
                                            <i class="fas fa-ruler mr-2"></i>Satuan Hasil
                                        </h6>
                                        <p class="card-text">{{ $rincianTugas->satuan_hasil ?? '-' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="card shadow-sm mb-3">
                                    <div class="card-body">
                                        <h6 class="card-title text-warning">
                                            <i class="fas fa-crosshairs mr-2"></i>Target
                                        </h6>
                                        <p class="card-text">{{ $rincianTugas->target ?? '-' }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card shadow-sm mb-3">
                                    <div class="card-body">
                                        <h6 class="card-title text-info">
                                            <i class="fas fa-sync-alt mr-2"></i>Frekuensi
                                        </h6>
                                        <p class="card-text">{{ $rincianTugas->frekuensi ?? '-' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="card shadow-sm mb-3">
                                    <div class="card-body">
                                        <h6 class="card-title text-secondary">
                                            <i class="fas fa-cube mr-2"></i>Volume
                                        </h6>
                                        <p class="card-text">{{ $rincianTugas->volume ?? '-' }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card shadow-sm mb-3">
                                    <div class="card-body">
                                        <h6 class="card-title text-danger">
                                            <i class="fas fa-clock mr-2"></i>Waktu Penyelesaian
                                        </h6>
                                        <p class="card-text">
                                            {{ $rincianTugas->waktu_penyelesaian ?? '-' }}
                                            @if ($rincianTugas->waktu_penyelesaian)
                                                <span class="text-muted">menit</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Summary Card --}}
                        <div class="card bg-light">
                            <div class="card-body">
                                <h6 class="card-title">
                                    <i class="fas fa-chart-line mr-2"></i>Ringkasan
                                </h6>
                                <div class="row text-center">
                                    <div class="col-md-3">
                                        <div class="border-right">
                                            <h5 class="text-primary">{{ $rincianTugas->target ?? '0' }}</h5>
                                            <small class="text-muted">Target</small>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="border-right">
                                            <h5 class="text-success">{{ $rincianTugas->volume ?? '0' }}</h5>
                                            <small class="text-muted">Volume</small>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="border-right">
                                            <h5 class="text-warning">{{ $rincianTugas->frekuensi ?? '0' }}</h5>
                                            <small class="text-muted">Frekuensi</small>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <h5 class="text-danger">{{ $rincianTugas->waktu_penyelesaian ?? '0' }}</h5>
                                        <small class="text-muted">Menit</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        {{-- Tampilan Ketika Belum Ada Rincian --}}
                        <div class="text-center py-5">
                            <div class="mb-4">
                                <i class="fas fa-clipboard-list text-muted"
                                    style="font-size: 4rem; opacity: 0.3;"></i>
                            </div>
                            <h5 class="text-muted mb-3">Belum Ada Rincian Tugas</h5>
                            <p class="text-muted mb-0">
                                Rincian tugas untuk uraian tugas ini belum tersedia.<br>
                                Silakan hubungi administrator untuk menambahkan rincian tugas.
                            </p>
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times mr-2"></i>Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- CSS untuk Fixed Table Layout dan Checkbox Styling --}}
    <style>
        .table-custom-fixed {
            table-layout: fixed;
            width: 100%;
        }

        .table-custom-fixed th,
        .table-custom-fixed td {
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        /* PERBAIKAN UTAMA: Mencegah table terpotong saat modal dibuka */
        .table-container {
            position: relative;
            width: 100% !important;
            max-width: 100% !important;
            overflow-x: auto !important;
            min-width: 0 !important;
        }

        /* Fixed table layout dengan minimum width yang konsisten */
        .table-container table {
            table-layout: fixed !important;
            width: 100% !important;
            min-width: 1800px !important;
            /* Minimum width untuk semua kolom */
            border-collapse: separate !important;
            border-spacing: 0 !important;
        }

        /* Pastikan thead dan tbody mengikuti width yang sama */
        .table-container thead,
        .table-container tbody {
            width: 100% !important;
            min-width: 1800px !important;
        }

        /* Cell styling dengan word wrap yang proper */
        .table-container th,
        .table-container td {
            word-wrap: break-word !important;
            white-space: normal !important;
            overflow-wrap: break-word !important;
            padding: 8px 10px !important;
            vertical-align: top !important;
        }

        body.modal-open {
            overflow: hidden;
            padding-right: 0 !important;
        }

        .modal-open .main-sidebar,
        .modal-open .main-header {
            padding-right: 17px;
        }

        .modal-open .table-container {
            overflow-x: auto !important;
        }

        /* Highlight selected rows */
        .table-warning {
            background-color: rgba(255, 193, 7, 0.15) !important;
        }

        /* Header checkbox styling */
        .header-checkbox {
            width: 1.8rem !important;
            height: 1.8rem !important;
            margin-top: 0 !important;
            cursor: pointer !important;
        }

        .header-checkbox:checked {
            background-color: #007bff !important;
            border-color: #007bff !important;
        }

        /* Item checkbox styling */
        .item-checkbox {
            width: 1.5rem !important;
            height: 1.5rem !important;
            margin-top: 0 !important;
            cursor: pointer !important;
        }

        .item-checkbox:checked {
            background-color: #28a745 !important;
            border-color: #28a745 !important;
        }

        /* Submit button styling */
        .btn-success:disabled {
            background-color: #6c757d;
            border-color: #6c757d;
            opacity: 0.65;
        }

        /* Loading animation */
        @keyframes bounce {

            0%,
            80%,
            100% {
                transform: scale(0);
            }

            40% {
                transform: scale(1);
            }
        }

        /* Loading button states */
        .btn:disabled {
            opacity: 0.6 !important;
            cursor: not-allowed !important;
            pointer-events: none !important;
        }


        /* Smooth transitions for loading states */
        .btn {
            transition: all 0.3s ease !important;
        }


        /* Loading spinner animation */
        .fa-spin {
            animation: fa-spin 1s infinite linear !important;
        }


        @keyframes fa-spin {
            0% {
                transform: rotate(0deg);
            }


            100% {
                transform: rotate(359deg);
            }
        }

        /* Modal rincian styling */
        .modal-lg {
            max-width: 900px !important;
        }


        .card {
            border: none !important;
            border-left: 4px solid #007bff !important;
        }


        .card:nth-child(2n) {
            border-left-color: #28a745 !important;
        }


        .card:nth-child(3n) {
            border-left-color: #ffc107 !important;
        }


        .card:nth-child(4n) {
            border-left-color: #17a2b8 !important;
        }


        .card:nth-child(5n) {
            border-left-color: #6c757d !important;
        }


        .card:nth-child(6n) {
            border-left-color: #dc3545 !important;
        }


        .bg-gradient-info {
            background: linear-gradient(45deg, #17a2b8, #138496) !important;
        }

        .border-right:not(:last-child) {
            border-right: 1px solid #dee2e6 !important;
        }

        /* Empty state styling */
        .fa-inbox {
            opacity: 0.3 !important;
        }

        /* Responsive untuk mobile */
        @media (max-width: 768px) {
            .table-container {
                overflow-x: scroll !important;
            }

            .btn-sm {
                padding: 0.25rem 0.5rem !important;
                font-size: 0.75rem !important;
            }

            .header-checkbox,
            .item-checkbox {
                width: 1.2rem !important;
                height: 1.2rem !important;
            }
        }

        /* Scroll styling untuk better UX */
        .table-container::-webkit-scrollbar {
            height: 8px;
        }

        .table-container::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }

        .table-container::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 4px;
        }

        .table-container::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }
    </style>

    {{-- DataTables CSS and JS --}}
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

    {{-- JavaScript untuk handling checkbox, modal events, dan DataTables --}}
    <script>
        // Initialize DataTables specifically for table2
        function initializeDataTablesForTable2() {
            console.log('Initializing DataTables for Table2');

            // Destroy existing DataTable instance if exists
            if ($.fn.DataTable.isDataTable('#example2')) {
                $('#example2').DataTable().destroy();
            }

            // Check if table exists in DOM before initialization
            if ($('#example2').length) {
                $("#example2").DataTable({
                    "responsive": false,
                    "lengthChange": true,
                    "lengthMenu": [
                        [10, 25, 50, 100, -1],
                        [10, 25, 50, 100, "Semua"]
                    ],
                    "autoWidth": false,
                    "searching": true,
                    "paging": true,
                    "ordering": false,
                    "scrollX": true,
                    "info": true,
                    "columnDefs": [{
                            "orderable": false,
                            "targets": [-1, -2]
                        },
                        {
                            "className": "checkbox-column",
                            "targets": [-2]
                        },
                        {
                            "className": "action-column",
                            "targets": [-1]
                        }
                    ],
                    "stateSave": false,
                    "language": {
                        "search": "Cari:",
                        "lengthMenu": "Tampilkan _MENU_ data per halaman",
                        "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                        "infoEmpty": "Menampilkan 0 sampai 0 dari 0 data",
                        "infoFiltered": "(disaring dari _MAX_ total data)",
                        "paginate": {
                            "first": "Pertama",
                            "last": "Terakhir",
                            "next": "Selanjutnya",
                            "previous": "Sebelumnya"
                        },
                        "emptyTable": "Tidak ada data yang tersedia",
                        "zeroRecords": "Tidak ada data yang cocok"
                    }
                });
                console.log('DataTables initialized for Table2');
            } else {
                console.log('Table #example2 not found in DOM');
            }
        }

        function initializeCheckboxLogic() {
            const selectAllCheckbox = document.getElementById('selectAll');
            const childCheckboxes = document.querySelectorAll('.child-checkbox');

            if (!selectAllCheckbox) return;

            selectAllCheckbox.addEventListener('change', function() {
                const isChecked = this.checked;
                childCheckboxes.forEach(checkbox => {
                    checkbox.checked = isChecked;
                    checkbox.dispatchEvent(new Event('input', {
                        bubbles: true
                    }));
                });
            });

            function syncSelectAllState() {
                const total = childCheckboxes.length;
                const checkedCount = document.querySelectorAll('.child-checkbox:checked').length;

                if (total > 0) {
                    if (checkedCount === total) {
                        selectAllCheckbox.checked = true;
                        selectAllCheckbox.indeterminate = false;
                    } else if (checkedCount > 0) {
                        selectAllCheckbox.checked = false;
                        selectAllCheckbox.indeterminate = true;
                    } else {
                        selectAllCheckbox.checked = false;
                        selectAllCheckbox.indeterminate = false;
                    }
                }
            }

            childCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', syncSelectAllState);
            });

            syncSelectAllState();
        }

        // Initialize when DOM is ready
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Table2 DOM Content Loaded');
            setTimeout(() => {
                initializeDataTablesForTable2();
                initializeCheckboxLogic();
            }, 500);
        });

        // Initialize when Livewire is ready
        document.addEventListener('livewire:initialized', function() {
            console.log('Table2 Livewire initialized');
            setTimeout(() => {
                initializeDataTablesForTable2();
                initializeCheckboxLogic();
            }, 300);
        });

        // Reinitialize after Livewire updates
        Livewire.hook('message.processed', (message, component) => {
            if (component.name === 'staf-user.staf-user-table2') {
                setTimeout(() => {
                    initializeDataTablesForTable2();
                    initializeCheckboxLogic();
                }, 100);
            }
        });

        // Event listener untuk modal rincian tugas
        window.addEventListener('showRincianTugasModal', function() {
            console.log('Opening rincian tugas modal for table2');
            $('#rincianTugasModal2').modal('show');
        });

        // Event listener dari Livewire untuk modal rincian tugas
        Livewire.on('showRincianTugasModal', function() {
            console.log('Livewire event: Opening rincian tugas modal for table2');
            $('#rincianTugasModal2').modal('show');
        });
    </script>
</div>
