@extends('layouts.app')

@push('styles')
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <style>
        .table-bordered {
            border-collapse: separate !important;
            border-spacing: 0;
            border-radius: 10px;
            overflow: hidden;
        }

        .table-bordered thead tr {
            background: linear-gradient(90deg, #00c6ff 0%, #0072ff 100%) !important;
            color: #fff !important;
        }

        .table-bordered thead th {
            text-align: left !important;
            vertical-align: top !important;
            font-weight: 600;
            padding: 10px;
            border: 1px solid #ddd !important;
        }

        .table-bordered thead th:first-child {
            border-top-left-radius: 10px;
        }

        .table-bordered thead th:last-child {
            border-top-right-radius: 10px;
        }

        .table-bordered tbody td {
            vertical-align: top !important;
            padding: 8px 10px;
            border: 1px solid #ddd !important;
            color: #333;
            font-size: 13px;
        }

        .table-bordered tbody tr:hover {
            background-color: rgba(0, 188, 212, 0.05);
            cursor: pointer;
        }

        tr[style*="background-color: #eeee"] {
            background-color: rgba(238, 238, 238, 0.5) !important;
        }

        /* Style for subtotal row */
        tr[style*="background-color: #bcbcbc"] {
            background: linear-gradient(90deg, #bcbcbc 0%, #d4d4d4 100%) !important;
        }

        .page-title {
            font-size: 24px;
            font-weight: 700;
            color: #333;
            /* hitam polos */
            margin-bottom: 8px;
        }

        .breadcrumb {
            background: none;
            padding: 0;
            margin-bottom: 0;
            font-size: 14px;
        }

        .breadcrumb-item+.breadcrumb-item::before {
            content: '>';
            color: #999;
            padding: 0 8px;
        }

        .breadcrumb-item a {
            color: #007bff;
            text-decoration: none;
            transition: color 0.2s ease-in-out;
        }

        .breadcrumb-item a:hover {
            color: #0056b3;
            text-decoration: underline;
        }

        .breadcrumb-item.active {
            color: #6c757d;
        }

        .card {
            border: none;
            border-left: 4px solid #ffc107;
        }
    </style>
@endpush

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <h1 class="page-title">
                    Beranda
                </h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                </ol>
            </div>
        </section>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                @if (isset($data) && isset($labels))
                    {{-- BLOK KINERJA TERPADU --}}
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header font-weight-bold">
                                    <h3 class="card-title">
                                        <i class="fas fa-chart-pie mr-1"></i>
                                        {{-- Label Judul Dinamis --}}
                                        {{ $labels['card_title'] }}
                                    </h3>
                                    <div
                                        style="position: absolute; bottom: 0; left: 0; width: 100%; height: 4px; background: linear-gradient(90deg, #00c6ff, #0072ff); border-radius: 5px;">
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <!-- Beban Kerja Ideal -->
                                        <div class="col-lg-3 col-6">
                                            <div class="small-box bg-info">
                                                <div class="inner">
                                                    <h3>{{ number_format($data->abk_ideal ?? 0, 2) }}</h3>
                                                    {{-- Label Dinamis --}}
                                                    <p>{{ $labels['abk_ideal_label'] }}</p>
                                                </div>
                                                <div class="icon"><i class="ion ion-stats-bars"></i></div>
                                            </div>
                                        </div>

                                        <!-- Beban Kerja Berlebih -->
                                        <div class="col-lg-3 col-6">
                                            <div class="small-box bg-warning">
                                                <div class="inner">
                                                    <h3>{{ number_format($data->abk_berlebih ?? 0, 2) }}</h3>
                                                    {{-- Label Dinamis --}}
                                                    <p>{{ $labels['abk_berlebih_label'] }}</p>
                                                </div>
                                                <div class="icon"><i class="ion ion-arrow-graph-up-right"></i></div>
                                            </div>
                                        </div>

                                        <!-- Efektivitas dan Efesiensi Jabatan -->
                                        <div class="col-lg-3 col-6">
                                            <div class="small-box bg-success">
                                                <div class="inner">
                                                    <h3>{{ number_format($eej, 2) }}</h3>
                                                    {{-- Label Dinamis --}}
                                                    <p>{{ $labels['eej_label'] }}</p>
                                                </div>
                                                <div class="icon"><i class="ion ion-pie-graph"></i></div>
                                            </div>
                                        </div>

                                        <!-- Tingkat Prestasi Kerja Jabatan -->
                                        <div class="col-lg-3 col-6">
                                            <div class="small-box bg-danger">
                                                <div class="inner">
                                                    <h3>{{ $prestasi['teks'] }}</h3>
                                                    {{-- Label Dinamis --}}
                                                    <p>{{ $labels['prestasi_label'] }}</p>
                                                </div>
                                                <div class="icon"><i class="fas fa-trophy"></i></div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Tugas Layanan -->
                                    <div class="row mt-4">
                                        <div class="col-12">
                                            <div class="card bg-primary">
                                                <div class="card-body text-center position-relative">
                                                    <div class="icon"
                                                        style="position: absolute; right: 20px; top: 50%; transform: translateY(-50%); opacity: 0.3;">
                                                        <i class="fas fa-tasks" style="font-size: 70px;"></i>
                                                    </div>
                                                    <h1 class="display-4 text-white mb-0">{{ $tugasCount }}</h1>
                                                    {{-- Label Dinamis --}}
                                                    <p class="text-white mb-0">{{ $labels['tugas_label'] }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- BLOK STAF EKSISTING TERPADU --}}
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title font-weight-bold">
                                        <i class="fas fa-users mr-1"></i>
                                        {{-- Label Judul Dinamis --}}
                                        {{ $labels['staf_card_title'] }}
                                    </h3>
                                    <div
                                        style="position: absolute; bottom: 0; left: 0; width: 100%; height: 4px; background: linear-gradient(90deg, #00c6ff, #0072ff); border-radius: 5px;">
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-3 col-6">
                                            <div class="small-box bg-gradient-primary">
                                                <div class="inner">
                                                    <h3>{{ $data->pns ?? 0 }}</h3>
                                                    <p>{{ $labels['pns_label'] }}</p>
                                                </div>
                                                <div class="icon"><i class="fas fa-user-tie"></i></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                            <div class="small-box bg-gradient-success">
                                                <div class="inner">
                                                    <h3>{{ $data->pppk ?? 0 }}</h3>
                                                    <p>{{ $labels['pppk_label'] }}</p>
                                                </div>
                                                <div class="icon"><i class="fas fa-user-shield"></i></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                            <div class="small-box bg-gradient-danger">
                                                <div class="inner">
                                                    <h3>{{ $data->cpns ?? 0 }}</h3>
                                                    <p>{{ $labels['cpns_label'] }}</p>
                                                </div>
                                                <div class="icon"><i class="fas fa-user-graduate"></i></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                            <div class="small-box bg-gradient-warning">
                                                <div class="inner">
                                                    <h3>{{ $data->non_pns ?? 0 }}</h3>
                                                    <p>{{ $labels['non_pns_label'] }}</p>
                                                </div>
                                                <div class="icon"><i class="fas fa-user-clock"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="alert alert-info">
                        Tidak ada data kinerja untuk ditampilkan.
                    </div>
                @endif

                @if (Auth::user()->role == 'admin')
                    <div>
                        @livewire('dashboard-conten.data-summary')
                    </div>
                @endif

                @if (Auth::user()->role == 'user' || Auth::user()->role == 'kepala' || Auth::user()->role == 'subkepala')
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title font-weight-bold">
                                        <i class="fas fa-briefcase mr-1"></i>
                                        Data Kebutuhan Pegawai Perangkat Daerah Anda
                                    </h3>
                                    <div
                                        style="position: absolute; bottom: 0; left: 0; width: 100%; height: 4px; background: linear-gradient(90deg, #00c6ff, #0072ff); border-radius: 5px;">
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="mb-3 col-md-4">
                                            <form action="" method="GET">
                                                <div class="input-group">
                                                    <input type="text" name="search" class="form-control"
                                                        placeholder="Cari berdasarkan nama jabatan staf"
                                                        value="{{ $search }}">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-primary" type="submit">
                                                            <i class="fas fa-search"></i> Cari
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="width: 25%;">Nomenklatur Jabatan Struktural</th>
                                                <th style="width: 25%;">Nama Jabatan Staf</th>
                                                <th style="width: 8%;">ABK Ideal</th>
                                                <th style="width: 8%;">ABK Berlebih</th>
                                                <th style="width: 15%;">Pemenuhan Pegawai</th>
                                                <th style="width: 14%;">Jumlah Eksisting</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($datastafutamas as $stafutama)
                                                <tr style="background-color: #eeee;">
                                                    <td>
                                                        <h5 class="font-weight-bold text-primary">
                                                            {{ $stafutama->nama_jabatan }}</h5>
                                                    </td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>

                                                @if ($stafutama->users && $stafutama->users->isNotEmpty())
                                                    @foreach ($stafutama->users->groupBy('jabatan_staf') as $namaGrup => $listStaf)
                                                        <tr style="background-color: #f7f7f7;">
                                                            <td></td>
                                                            <td>
                                                                <h6 class="font-weight-bold text-secondary">
                                                                    @if ($namaGrup == 'fungsional')
                                                                        Jabatan Fungsional
                                                                    @elseif ($namaGrup == 'pelaksana')
                                                                        Jabatan Pelaksana
                                                                    @else
                                                                        Lainnya
                                                                    @endif
                                                                </h6>
                                                            </td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>

                                                        @foreach ($listStaf as $user)
                                                            @php
                                                                $uraianTugas = $user->uraianTugasStaf;
                                                                $allDetailTugas = $uraianTugas
                                                                    ? $uraianTugas->semuaDetailTugas
                                                                    : collect();
                                                                $totalAbkIdeal = $allDetailTugas->sum('abk_ideal');
                                                                $totalAbkBerlebih = $allDetailTugas->sum(
                                                                    'abk_berlebih',
                                                                );
                                                            @endphp
                                                            <tr>
                                                                <td></td> 

                                                                <td class="font-weight-bold">
                                                                    <ul style="padding-left: 20px; margin-bottom: 0;">
                                                                        <li>
                                                                            <a href="{{ route('staf-user', $user->id) }}"
                                                                                class="text-dark text-md">
                                                                                {{ $user->jabatan }}
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </td>

                                                                <td class="text-center font-weight-bold text-md">
                                                                    {{ number_format($totalAbkIdeal, 2) }}
                                                                </td>
                                                                <td class="text-center font-weight-bold text-md">
                                                                    {{ number_format($totalAbkBerlebih, 2) }}
                                                                </td>
                                                                <td class="text-center font-weight-bold text-md">
                                                                    {{ $uraianTugas->pemenuhan_pegawai ?? 0 }}
                                                                </td>
                                                                <td class="text-center font-weight-bold text-md">
                                                                    <p class="mb-0">
                                                                        {{ $uraianTugas->jumlah_eksisting ?? 0 }}</p>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endforeach
                                                @endif


                                                {{-- Baris Subtotal --}}
                                                <tr style="line-height: 1; height: 28px;">
                                                    <td colspan="2" style="background-color: #f6f6f6">
                                                        <h5 class="font-weight-bold text-center">Subtotal</h5>
                                                    </td>
                                                    @php
                                                        $allUraianTugasSub = $stafutama->users
                                                            ->pluck('uraianTugasStaf')
                                                            ->filter()
                                                            ->flatten();
                                                        $allDetailTugasSub = $allUraianTugasSub->flatMap(
                                                            fn($uraian) => $uraian->semuaDetailTugas ?? collect(),
                                                        );
                                                    @endphp
                                                    <td class="text-center font-weight-bold text-md">
                                                        {{ number_format($allDetailTugasSub->sum('abk_ideal'), 2, ',', '.') }}
                                                    </td>
                                                    <td class="text-center font-weight-bold text-md">
                                                        {{ number_format($allDetailTugasSub->sum('abk_berlebih'), 2, ',', '.') }}
                                                    </td>
                                                    <td class="text-center font-weight-bold text-md">
                                                        {{ $allUraianTugasSub->sum('pemenuhan_pegawai') }}
                                                    </td>
                                                    <td class="text-center font-weight-bold text-md">
                                                        {{ $allUraianTugasSub->sum('jumlah_eksisting') }}
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6" class="text-center">Data Anda tidak
                                                        ditemukan.</td>
                                                </tr>
                                            @endforelse
                                            {{-- BARIS GRAND TOTAL --}}
                                            @if ($datastafutamas->total() > 0)
                                                <tr style="background-color: #d7d7d7; line-height: 1; height: 28px;">
                                                    <td colspan="2">
                                                        <h5 class="font-weight-bold text-center">TOTAL KESELURUHAN</h5>
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
                                                </tr>
                                            @endif

                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-footer clearfix">
                                    <div class="d-flex justify-content-center">
                                        {{ $datastafutamas->appends(request()->input())->links() }}
                                    </div>
                                    <div class="text-center mt-2 text-muted small">
                                        Total: {{ $datastafutamas->total() }} |
                                        Per page: {{ $datastafutamas->perPage() }} |
                                        Current: {{ $datastafutamas->currentPage() }}
                                        <p>Halaman {{ $datastafutamas->currentPage() }} dari
                                            {{ $datastafutamas->lastPage() }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

    <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>

    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>
    <script src="{{ asset('dist/js/demo.js') }}"></script>
@endpush
