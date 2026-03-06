<div wire:ignore.self class="modal fade" id="rincianTugasModal" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
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
                            <strong>ID Uraian Tugas:</strong> {{ $rincianTugas->detail_uraian_tugas_staf_id }}<br>
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
                                    <p class="card-text">
                                        @if ($rincianTugas?->frekuensi)
                                            @switch($rincianTugas->frekuensi)
                                                @case('1')
                                                    Tahunan
                                                @break

                                                @case('2')
                                                    Semesteran
                                                @break

                                                @case('3')
                                                    Caturwulanan
                                                @break

                                                @case('4')
                                                    Triwulanan
                                                @break

                                                @case('6')
                                                    Dwi bulan
                                                @break

                                                @case('12')
                                                    Bulanan
                                                @break

                                                @case('52')
                                                    Mingguan
                                                @break

                                                @case('235')
                                                    (5 Hari Kerja)
                                                @break

                                                @case('287')
                                                    (6 Hari Kerja)
                                                @break

                                                @case('365')
                                                    (Setiap Hari)
                                                @break
                                            @endswitch
                                            ({{ $rincianTugas->frekuensi }})
                                        @else
                                            -
                                        @endif
                                    </p>
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
                            <i class="fas fa-clipboard-list text-muted" style="font-size: 4rem; opacity: 0.3;"></i>
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
