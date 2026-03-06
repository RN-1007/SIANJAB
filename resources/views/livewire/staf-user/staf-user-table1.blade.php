<div>
    <div>
        <table id="example1" class="table table-bordered table-striped"
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
                    <th class="text-center">Checkbox</th>
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
                    <tr>
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
                            <b @if (!$item->rincianTugas) class="text-danger" @endif>[{{ $tusiCounter }}.{{ $subTugasCounter }}]
                            </b>
                            @if ($item->rincianTugas)
                                <b>
                                    Isian Di Rubah
                                    {{ '' }}{{ optional($item->rincianTugas->updated_at)->format('Y-d-m') }}
                                </b>
                                <br>
                            @else
                                <b class="text-danger">Belum Ada Isi Rincian</b>
                                <br>
                            @endif
                            <span>{{ $item->uraian_tugas_staf ?? '' }}</span>

                            {{-- TOMBOL RINCIAN TUGAS DENGAN ICON BERKAS DAN LOADING --}}
                            <button wire:click="showRincianTugas({{ $item->id }})"
                                class="btn btn-sm btn-outline-info ms-2" title="Lihat Rincian Tugas"
                                wire:loading.attr="disabled" wire:target="showRincianTugas({{ $item->id }})">

                                {{-- Ikon normal --}}
                                <span wire:loading.remove wire:target="showRincianTugas({{ $item->id }})">
                                    <i class="fas fa-folder-open"></i>
                                </span>

                                {{-- Loading spinner --}}
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
                                        <a href="{{ Storage::url($item->data_pendukung_sebelumnya) }}" target="_blank"
                                            class="btn btn-sm btn-primary mb-1" title="Unduh File"><i
                                                class="fas fa-download"></i></a>
                                    @endif
                                    <br>
                                    {{-- BUTTON EDIT DENGAN LOADING STATE --}}
                                    <button
                                        wire:click="openDataPendukungModal({{ $item->id }}, 'update', 'data_pendukung_sebelumnya')"
                                        class="btn btn-sm btn-warning {{ $loadingModalId == $item->id && $loadingType == 'data_pendukung_sebelumnya' ? 'disabled' : '' }}"
                                        title="Edit Data Pendukung Sebelumnya" wire:loading.attr="disabled"
                                        wire:target="openDataPendukungModal({{ $item->id }}, 'update', 'data_pendukung_sebelumnya')">

                                        {{-- LOADING SPINNER --}}
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
                                    {{-- BUTTON TAMBAH DENGAN LOADING STATE --}}
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
                            @if (Auth::user()->role === 'admin')
                                {{-- Cek apakah sudah ada data pendukung --}}
                                @if ($item->data_pendukung)
                                    {{-- Jika data adalah link URL --}}
                                    @if ($item->type_data_pendukung == 'link')
                                        <a href="{{ $item->data_pendukung }}" target="_blank"
                                            class="btn btn-sm btn-info mb-1" title="Lihat Tautan">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        {{-- Jika data adalah file --}}
                                    @else
                                        <a href="{{ Storage::url($item->data_pendukung) }}" target="_blank"
                                            class="btn btn-sm btn-primary mb-1" title="Unduh File">
                                            <i class="fas fa-download"></i>
                                        </a>
                                    @endif
                                    <br>

                                    {{-- Tombol EDIT dengan loading state --}}
                                    <button
                                        wire:click="openDataPendukungModal({{ $item->id }}, 'update', 'data_pendukung')"
                                        class="btn btn-sm btn-warning" title="Edit Data Pendukung"
                                        wire:loading.attr="disabled"
                                        wire:target="openDataPendukungModal({{ $item->id }}, 'update', 'data_pendukung')">

                                        {{-- Ikon normal --}}
                                        <span wire:loading.remove
                                            wire:target="openDataPendukungModal({{ $item->id }}, 'update', 'data_pendukung')">
                                            <i class="fas fa-edit"></i>
                                        </span>
                                        {{-- Loading spinner --}}
                                        <span wire:loading
                                            wire:target="openDataPendukungModal({{ $item->id }}, 'update', 'data_pendukung')">
                                            <i class="fas fa-spinner fa-spin"></i>
                                        </span>
                                    </button>
                                @else
                                    {{-- Tombol TAMBAH dengan loading state (jika belum ada data) --}}
                                    <button
                                        wire:click="openDataPendukungModal({{ $item->id }}, 'upload', 'data_pendukung')"
                                        class="btn btn-sm btn-success" title="Tambah Data Pendukung"
                                        wire:loading.attr="disabled"
                                        wire:target="openDataPendukungModal({{ $item->id }}, 'upload', 'data_pendukung')">

                                        {{-- Ikon normal --}}
                                        <span wire:loading.remove
                                            wire:target="openDataPendukungModal({{ $item->id }}, 'upload', 'data_pendukung')">
                                            <i class="fas fa-plus"></i>
                                        </span>
                                        {{-- Loading spinner --}}
                                        <span wire:loading
                                            wire:target="openDataPendukungModal({{ $item->id }}, 'upload', 'data_pendukung')">
                                            <i class="fas fa-spinner fa-spin"></i>
                                        </span>
                                    </button>
                                @endif
                            @endif
                        </td>

                        {{-- Cek apakah ada catatan mahasiswa --}}

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
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="blue" style="width: 40px; height: 40px;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                            </svg>
                        </td>
                        <td class="text-center"> {{-- Ini adalah kolom Action yang benar di posisi terakhir --}}
                            @if (Auth::user()->role === 'admin')
                                <div class="d-inline-flex flex-column" role="group" aria-label="Action Buttons">
                                    {{-- TOMBOL EDIT DENGAN LOADING --}}
                                    <button wire:click="edit({{ $item->id }})" wire:loading.attr="disabled"
                                        wire:target="edit({{ $item->id }})" class="btn btn-sm btn-info mb-2"
                                        title="Edit Data">

                                        <span wire:loading.remove wire:target="edit({{ $item->id }})">
                                            <i class="fas fa-edit"></i>
                                        </span>
                                        <span wire:loading wire:target="edit({{ $item->id }})">
                                            <i class="fas fa-spinner fa-spin"></i>
                                        </span>
                                    </button>

                                    {{-- TOMBOL DELETE DENGAN LOADING --}}
                                    <button wire:click="confirmDelete({{ $item->id }})"
                                        wire:loading.attr="disabled" wire:target="confirmDelete({{ $item->id }})"
                                        class="btn btn-sm btn-danger" title="Hapus Data">

                                        <span wire:loading.remove wire:target="confirmDelete({{ $item->id }})">
                                            <i class="fas fa-trash"></i>
                                        </span>
                                        <span wire:loading wire:target="confirmDelete({{ $item->id }})">
                                            <i class="fas fa-spinner fa-spin"></i>
                                        </span>
                                    </button>
                                </div>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="13" class="text-center py-4">
                            <div class="text-muted">
                                <i class="fas fa-check-circle fa-3x mb-3 text-success"></i>
                                <h5>Semua data sudah lengkap</h5>
                                <p>Tidak ada data yang perlu ditampilkan di sini.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div wire:ignore.self class="modal fade" id="rincianTugasModal" tabindex="-1"
        aria-labelledby="rincianTugasModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-gradient-info text-white">
                    <h5 class="modal-title" id="rincianTugasModalLabel">
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

    <!-- Edit Modal -->
    <div wire:ignore.self class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form wire:submit.prevent="update">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Data Tugas Staf</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            wire:click="resetInputFields">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @if ($selectedId)
                            <div class="form-group">
                                <label>Uraian Tugas</label>
                                <textarea wire:model.defer="form.uraian_tugas_staf"
                                    class="form-control @error('form.uraian_tugas_staf') is-invalid @enderror" rows="3"></textarea>
                                @error('form.uraian_tugas_staf')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <hr>
                            <div class="form-group">
                                <label>Hasil Kerja</label>
                                <input type="text" wire:model.defer="form.hasil_kerja"
                                    class="form-control @error('form.hasil_kerja') is-invalid @enderror">
                                @error('form.hasil_kerja')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Satuan Hasil</label>
                                <input type="text" wire:model.defer="form.satuan_hasil"
                                    class="form-control @error('form.satuan_hasil') is-invalid @enderror">
                                @error('form.satuan_hasil')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Target</label>
                                <input type="number" wire:model.defer="form.target"
                                    class="form-control @error('form.target') is-invalid @enderror">
                                @error('form.target')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Frekuensi / Shift</label>
                                <select class="form-control @error('form.frekuensi') is-invalid @enderror"
                                    wire:model.defer="form.frekuensi">
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
                                @error('form.frekuensi')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Waktu Penyelesaian (menit)</label>
                                <input type="number" wire:model.defer="form.waktu_penyelesaian"
                                    class="form-control @error('form.waktu_penyelesaian') is-invalid @enderror">
                                <span class="text-danger font-weight-bold font-italic">*Maksimal waktu diisi 330</span>
                                @error('form.waktu_penyelesaian')
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
                            wire:click="resetInputFields">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div wire:ignore.self class="modal fade" id="deleteConfirmModal" tabindex="-1"
        aria-labelledby="deleteConfirmLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        wire:click="resetDeleteState">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        wire:click="resetDeleteState">Batal</button>
                    <button type="button" wire:click="destroy" class="btn btn-danger">Hapus</button>
                </div>
            </div>
        </div>
    </div>

    {{-- CSS untuk Fixed Table Layout --}}
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

        /* Fix untuk table width dan responsiveness */
        .table-responsive-fix {
            display: block;
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .table-responsive-fix table {
            width: 100%;
            table-layout: fixed;
        }

        .table-responsive-fix th,
        .table-responsive-fix td {
            word-wrap: break-word !important;
            white-space: normal !important;
            overflow-wrap: break-word !important;
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
            opacity: 0.6;
            cursor: not-allowed;
        }

        /* Smooth transitions for loading states */
        .btn {
            transition: all 0.3s ease;
        }

        /* Loading spinner animation */
        .fa-spin {
            animation: fa-spin 1s infinite linear;
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
            max-width: 900px;
        }

        .card {
            border: none;
            border-left: 4px solid #007bff;
        }

        .card:nth-child(2n) {
            border-left-color: #28a745;
        }

        .card:nth-child(3n) {
            border-left-color: #ffc107;
        }

        .card:nth-child(4n) {
            border-left-color: #17a2b8;
        }

        .card:nth-child(5n) {
            border-left-color: #6c757d;
        }

        .card:nth-child(6n) {
            border-left-color: #dc3545;
        }

        .bg-gradient-info {
            background: linear-gradient(45deg, #17a2b8, #138496) !important;
        }

        .border-right:not(:last-child) {
            border-right: 1px solid #dee2e6 !important;
        }
    </style>

    {{-- JavaScript untuk Debug dan Fallback --}}
    <script>
        // Fungsi untuk inisialisasi DataTable
        function initializeDataTable() {
            if ($.fn.DataTable.isDataTable('#example1')) {
                $('#example1').DataTable().destroy();
            }
            
            $('#example1').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": false,
                "scrollX": true,
                "language": {
                    "search": "Cari:",
                    "lengthMenu": "Tampilkan _MENU_ data per halaman",
                    "zeroRecords": "Tidak ada data yang ditemukan",
                    "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                    "infoEmpty": "Tidak ada data yang tersedia",
                    "infoFiltered": "(difilter dari _MAX_ total data)",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": "Selanjutnya",
                        "previous": "Sebelumnya"
                    }
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM Content Loaded');
            
            // Inisialisasi DataTable saat halaman dimuat
            initializeDataTable();

            // Test jika modal ada di DOM
            const modal = document.getElementById('staf-data-pendukung');
            if (modal) {
                console.log('Modal staf-data-pendukung found in DOM');
            } else {
                console.error('Modal staf-data-pendukung NOT found in DOM');
            }

            // Function untuk test modal manual
            window.testModal = function() {
                console.log('Testing modal...');
                $('#staf-data-pendukung').modal('show');
            };

            console.log('Test function available: testModal()');
        });

        // Livewire initialized event
        document.addEventListener('livewire:initialized', function() {
            console.log('Livewire initialized');

            // Listen untuk event modal
            Livewire.on('open-modal-with-js', function(event) {
                console.log('Received open-modal-with-js event:', event);

                // Force open modal with jQuery
                setTimeout(function() {
                    $('#staf-data-pendukung').modal('show');
                    console.log('Modal opened with jQuery fallback');
                }, 100);
            });

            // Debug semua Livewire events
            Livewire.on('*', function(event, data) {
                console.log('Livewire Event:', event, data);
            });
            
            // Reinisialisasi DataTable setelah Livewire update
            Livewire.hook('message.processed', (message, component) => {
                console.log('Livewire message processed, reinitializing DataTable');
                initializeDataTable();
            });
        });

        // jQuery ready
        $(document).ready(function() {
            console.log('jQuery ready');

            // Test modal events
            $('#staf-data-pendukung').on('show.bs.modal', function() {
                console.log('Modal is about to show');
            });

            $('#staf-data-pendukung').on('shown.bs.modal', function() {
                console.log('Modal is now visible');
            });

            $('#staf-data-pendukung').on('hide.bs.modal', function() {
                console.log('Modal is about to hide');
            });
            
            // Reinisialisasi DataTable setelah modal ditutup
            $('#staf-data-pendukung, #rincianTugasModal, #editModal, #deleteConfirmModal').on('hidden.bs.modal', function() {
                console.log('Modal closed, reinitializing DataTable');
                initializeDataTable();
            });
        });
    </script>
</div>
