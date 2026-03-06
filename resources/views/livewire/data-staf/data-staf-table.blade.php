<div>
    <div class="row">
        <div class="col-12">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title font-weight-bold">Cari Perangkat Deaerah</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
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
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group" wire:ignore>
                                <label>Perangkat Daerah</label>
                                <select class="select2" id="skpd-select" style="width: 100%;">
                                    <option value="">-- Pilih Perangkat Daerah --</option>
                                    @foreach ($dataskpd as $skpd)
                                        <option value="{{ $skpd->id }}">{{ $skpd->nama_pd }}</option>
                                    @endforeach
                                </select>
                            </div>
                            </div>
                        </div>
                </div>
            </div>
            </div>
        </div>
    @if (!empty($selectedSkpd))
        <div class="row">
            <div class="col-12">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title font-weight-bold text-capitalize">Nama Perangkat Daerah -
                            {{ $skpdObject->nama_pd }}
                        </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
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
                    </div>

                    <div class="card-body">

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <input wire:model.live.debounce.100ms="search" type="text" class="form-control"
                                    placeholder="Cari Jabatan Struktural atau Jabatan Staf...">
                            </div>
                        </div>

                        <table id="example1" class="table table-bordered"
                            wire:key="data-staf-table-{{ $selectedSkpd }}">
                            <thead>
                                <tr>
                                    <th style="width: 25%;">Nomenklatur Jabatan Struktural</th>
                                    <th style="width: 25%;">Nama Jabatan Staf</th>
                                    <th style="width: 8%;">ABK Ideal</th>
                                    <th style="width: 8%;">ABK Berlebih</th>
                                    <th style="width: 15%;">Pemenuhan Pegawai Maksimal</th>
                                    <th style="width: 14%;">Jumlah Eksisting Pegawai</th>
                                    <th style="width: 15%;">Uraian Tugas Blm di Verifikasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($datastafutamas as $stafutama)
                                    <tr style="background-color: #eeee;">
                                        <td>
                                            <h5 class="font-weight-bold text-primary">
                                                {{ $stafutama->nomenklatur_jabatan_struktural }}
                                            </h5>
                                        </td>
                                        <td></td>
                                        <td class="text-center font-weight-bold"></td>
                                        <td class="text-center font-weight-bold"></td>
                                        <td class="text-center font-weight-bold"></td>
                                        <td class="text-center font-weight-bold"></td>
                                        <td class="text-center font-weight-bold"></td>
                                    </tr>

                                    @foreach ($stafutama->jabatanStaf->groupBy('jabatan_staf') as $namaGrup => $listStaf)
                                        <tr style="background-color: #eeee;">
                                            <td></td>
                                            <td>
                                                <h5 class="font-weight-bold text-primary">
                                                    @if ($namaGrup == 'fungsional')
                                                        Jabatan Fungsional
                                                    @elseif ($namaGrup == 'pelaksana')
                                                        Jabatan Pelaksana
                                                    @elseif ($namaGrup == 'penunjang')
                                                        Jabatan Penunjang
                                                    @else
                                                        Tidak Diketahui
                                                    @endif
                                                </h5>
                                            </td>
                                            <td class="text-center font-weight-bold"></td>
                                            <td class="text-center font-weight-bold"></td>
                                            <td class="text-center font-weight-bold"></td>
                                            <td class="text-center font-weight-bold"></td>
                                            <td class="text-center font-weight-bold"></td>
                                        </tr>

                                        @foreach ($listStaf as $jabatanstaf)
                                            @php
                                                $allDetailTugas = $jabatanstaf->semuaDetailTugas;

                                                $totalAbkIdeal = $allDetailTugas->sum('abk_ideal');
                                                $totalAbkBerlebih = $allDetailTugas->sum('abk_berlebih');
                                                $tugasBelumVerifikasi = $allDetailTugas
                                                    ->where('status', 'belum')
                                                    ->count();

                                                $uraianTugas = $jabatanstaf->uraianTugasStaf;
                                            @endphp

                                            <tr>
                                                <td></td>
                                                <td class="font-weight-bold">
                                                    <ul>
                                                        <li style="margin-left: -20px;">
                                                            <a href="{{ route('staf-user', $jabatanstaf->id) }}"
                                                                class="text-dark text-md">
                                                                {{ $jabatanstaf->jabatan }}
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </td>
                                                <td class="text-center font-weight-bold text-md">
                                                    {{ $totalAbkIdeal }}
                                                </td>
                                                <td class="text-center font-weight-bold text-md">
                                                    {{ $totalAbkBerlebih }}
                                                </td>
                                                <td class="text-center font-weight-bold text-md">
                                                    {{ $uraianTugas->pemenuhan_pegawai ?? 0 }}
                                                </td>
                                                <td class="text-center font-weight-bold text-md">
                                                    <p>{{ $uraianTugas->jumlah_eksisting ?? 0 }}</p>
                                                    @if ($uraianTugas->id ?? false)
                                                        <button type="button" class="btn btn-warning btn-sm mb-2"
                                                            wire:key="edit-button-{{ $uraianTugas?->id }}"
                                                            wire:click="$dispatch('openEditPemenuhanModal', { uraianTugasId: {{ $uraianTugas->id }} })">
                                                            <i class="fas fa-pen"></i>
                                                        </button>
                                                    @endif
                                                </td>
                                                <td class="text-center font-weight-bold text-md">
                                                    {{ $tugasBelumVerifikasi }}</td>
                                            </tr>
                                        @endforeach
                                    @endforeach

                                    {{-- Subtotal --}}
                                    <tr style="line-height: 1; height: 28px;">
                                        <td colspan="2" style="background-color: #f6f6f6">
                                            <h5 class="font-weight-bold text-center">Subtotal</h5>
                                        </td>
                                        @php
                                            $allUraianTugas = $stafutama->jabatanStaf
                                                ->pluck('uraianTugasStaf')
                                                ->filter()
                                                ->flatten();

                                            $allDetailTugas = $allUraianTugas->flatMap(function ($uraian) {
                                                return $uraian->semuaDetailTugas;
                                            });
                                        @endphp

                                        <td class="text-center font-weight-bold text-md">
                                            {{ number_format($allDetailTugas->sum('abk_ideal'), 2, ',', '.') }}
                                        </td>
                                        <td class="text-center font-weight-bold text-md">
                                            {{ number_format($allDetailTugas->sum('abk_berlebih'), 2, ',', '.') }}
                                        </td>
                                        <td class="text-center font-weight-bold text-md">
                                            {{ $allUraianTugas->sum('pemenuhan_pegawai') }}
                                        </td>
                                        <td class="text-center font-weight-bold text-md">
                                            {{ $allUraianTugas->sum('jumlah_eksisting') }}
                                        </td>
                                        <td class="text-center font-weight-bold text-md">
                                            {{ $allDetailTugas->where('status', '=', 'belum')->count() }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Pilih PD untuk menampilkan data.</td>
                                    </tr>
                                @endforelse

                                @if (!empty($selectedSkpd) && $datastafutamas->total() > 0)
                                    <tr style="background-color: #d7d7d7;line-height: 1; height: 28px; border-top: 2px solid #999;">
                                        <td colspan="2">
                                            <h5 class="font-weight-bold text-center">TOTAL KESELURUHAN (SEMUA HALAMAN)</h5>
                                        </td>
                                        <td class="text-center font-weight-bold text-md">
                                            {{ number_format($grandTotalData['abk_ideal'], 2, ',', '.') }}
                                        </td>
                                        <td class="text-center font-weight-bold text-md">
                                            {{ number_format($grandTotalData['abk_berlebih'], 2, ',', '.') }}
                                        </td>
                                        <td class="text-center font-weight-bold text-md">
                                            {{ $grandTotalData['pemenuhan_pegawai'] }}
                                        </td>
                                        <td class="text-center font-weight-bold text-md">
                                            {{ $grandTotalData['jumlah_eksisting'] }}
                                        </td>
                                        <td class="text-center font-weight-bold text-md">
                                            {{ $grandTotalData['uraian_tugas_belum_verif'] }}
                                        </td>
                                    </tr>
                                @endif

                            </tbody>
                        </table>
                        <div class="mt-3">
                            {{ $datastafutamas->links() }}
                        </div>
                    </div>

                </div>
                </div>
            </div>
    @endif
</div>