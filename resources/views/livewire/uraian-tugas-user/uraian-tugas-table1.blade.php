<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title font-weight-bold"> <i class="fas fa-check-circle mr-2 text-success"> </i>Data Uraian
                    Tugas Staf Yang Sudah Diterima</h3>
                <div
                    style="
                                position: absolute;
                                bottom: 0;
                                left: 0;
                                width: 100% ;
                                height: 4px;
                                background: linear-gradient(90deg, #00c6ff, #0072ff);
                                border-radius: 5px;">
                </div>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body" style="overflow-x: auto; width: 100%;">
                @if ($dataUraianTugasValid->isEmpty())
                    <div class="alert alert-info">
                        Tidak ada data uraian tugas yang ditemukan untuk Anda.
                    </div>
                @else
                    <table id="example1" class="table table-bordered table-striped"
                        style="width: 100%; min-width: 1500px;">
                        <colgroup>
                            <col style="width: 50px;"> <!-- No -->
                            <col style="width: 200px;"> <!-- Tugas dan Fungsi -->
                            <col style="width: 300px;"> <!-- Uraian Tugas -->
                            <col style="width: 80px;"> <!-- ABK Ideal -->
                            <col style="width: 90px;"> <!-- ABK Berlebih -->
                            <col style="width: 130px;"> <!-- Nama Jabatan Permenpan 45 -->
                            <col style="width: 130px;"> <!-- Nama Jabatan Permenpan 41 -->
                            <col style="width: 110px;"> <!-- Data Pendukung 2024 -->
                            <col style="width: 110px;"> <!-- Data Pendukung -->
                            <col style="width: 110px;"> <!-- Catatan Mahasiswa -->
                            <col style="width: 80px;"> <!-- Action -->
                        </colgroup>

                        <thead>
                            <tr class="">
                                <th class="text-center">No</th>
                                <th class="">Tugas dan Fungsi</th>
                                <th class="">Uraian Tugas Staf</th>
                                <th class="text-center">ABK Ideal</th>
                                <th class="text-center">ABK Berlebih</th>
                                <th class="">Nama Jabatan Permenpan 45</th>
                                <th class="">Nama Jabatan Permenpan 41</th>
                                <th class="text-center">Data Pendukung Sebelumnya</th>
                                <th class="text-center">Data Pendukung</th>
                                <th class="">Catatan Mahasiswa</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $tusiCounter = 0;
                                $subTugasCounter = 0;
                                $previousTusiId = null;
                            @endphp

                            @foreach ($dataUraianTugasValid as $item)
                                @php $currentTusiId = optional(optional($item->uraianTugas)->tusi)->id; @endphp
                                <tr>
                                    @if ($currentTusiId != $previousTusiId)
                                        @php
                                            $tusiCounter++;
                                            $subTugasCounter = 1;
                                            $previousTusiId = $currentTusiId;
                                        @endphp
                                        <td class="text-center font-weight-bold">{{ $tusiCounter }}.</td>
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

                                        @if ($item->rincianTugas)
                                            <button type="button" class="btn btn-sm btn-outline-info ms-2"
                                                title="Lihat Rincian Tugas"
                                                wire:click="$dispatch('showRincianTugasModal', { rincianTugasId: {{ $item->rincianTugas->id }} })">
                                                <i class="fas fa-folder-open"></i>
                                            </button>
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $item->abk_ideal ?? '' }}</td>
                                    <td class="text-center">{{ $item->abk_berlebih ?? '' }}</td>
                                    <td>{{ optional(optional($item->uraianTugas)->tusi)->nama_jabatan_permempan_45 ?? '' }}
                                    </td>
                                    <td>{{ optional(optional($item->uraianTugas)->tusi)->nama_jabatan_permempan_41 ?? '' }}
                                    </td>
                                    <td class="text-center">
                                        @if ($item->data_pendukung_sebelumnya)
                                            @if ($item->type_data_pendukung_sebelumnya === 'link')
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
                                                wire:click="$dispatch('showDataPendukungModal', { uraianTugasId: {{ $item->id }}, type: 'update', targetColumn: 'data_pendukung_sebelumnya' })"
                                                class="btn btn-sm btn-warning" title="Edit Data Pendukung Sebelumnya">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        @else
                                            <button
                                                wire:click="$dispatch('showDataPendukungModal', { uraianTugasId: {{ $item->id }}, type: 'upload', targetColumn: 'data_pendukung_sebelumnya' })"
                                                class="btn btn-sm btn-success" title="Tambah Data Pendukung Sebelumnya">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($item->data_pendukung)
                                            @if ($item->type_data_pendukung === 'link')
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
                                                wire:click="$dispatch('showDataPendukungModal', { uraianTugasId: {{ $item->id }}, type: 'update', targetColumn: 'data_pendukung' })"
                                                class="btn btn-sm btn-warning" title="Edit Data Pendukung">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        @else
                                            <button
                                                wire:click="$dispatch('showDataPendukungModal', { uraianTugasId: {{ $item->id }}, type: 'upload', targetColumn: 'data_pendukung' })"
                                                class="btn btn-sm btn-success" title="Tambah Data Pendukung">
                                                <i class="fas fa-plus"></i>
                                            </button>
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
                                        <button
                                            wire:click="$dispatch('openEditModal', { uraianTugasId: {{ $item->id }} })"
                                            class="btn btn-sm btn-info me-1 mb-1" title="Edit Uraian Tugas">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <br>
                                        <button
                                            wire:click="$dispatch('openDeleteModal', { uraianTugasId: {{ $item->id }} })"
                                            class="btn btn-sm btn-danger me-1" title="Edit Uraian Tugas">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>
