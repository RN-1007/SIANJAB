@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <style>
        /* CSS DARI CONTOH ANDA DITAMBAHKAN DI SINI */
        .treegrid-child {
            display: none; /* Sembunyikan anak secara default */
        }

        .treegrid-parent {
            cursor: pointer; /* Buat parent bisa di-klik */
        }

        .expand-caret {
            margin-right: 8px;
            transition: transform 0.2s ease-in-out;
            /* Penyesuaian agar ikon sedikit ke kiri padding */
            margin-left: -1.25rem; 
            width: 1.25rem; /* Beri ruang agar tidak menggeser teks */
        }

        .treegrid-parent.expanded .expand-caret {
            transform: rotate(90deg); /* Rotasi ikon saat dibuka */
        }

        /* Ikon untuk anak (leaf node) */
        .leaf-icon {
            margin-right: 8px;
            margin-left: -1.25rem;
            width: 1.25rem;
            font-size: 0.6rem;
            opacity: 0.5;
        }
        
        /* STYLING TABEL ASLI ANDA */
        .table thead tr {
            background: linear-gradient(90deg, #00c6ff 0%, #0072ff 100%) !important;
            color: #fff !important;
        }

        .table thead th {
            text-align: left !important;
            vertical-align: middle !important;
            padding: 10px;
        }

        .table tbody td {
            text-align: left !important;
            vertical-align: middle !important;
            border: 1px solid #ddd !important;
            color: #333;
        }

        .table tbody tr:hover {
            background-color: rgba(0, 188, 212, 0.05);
        }

        .table {
            border-collapse: separate !important;
            border-spacing: 0;
            border-radius: 10px;
            overflow: hidden;
        }

        .table thead th:first-child {
            border-top-left-radius: 10px;
        }

        .table thead th:last-child {
            border-top-right-radius: 10px;
        }

        .total-row,
        .total-row:hover {
            background: linear-gradient(90deg, #00c6ff 0%, #0072ff 100%) !important;
            color: white !important;
            font-weight: bold;
        }

        .page-title {
            font-size: 24px;
            font-weight: 700;
            color: #333;
            margin-bottom: 8px;
        }

        .breadcrumb {
            background: none;
            padding: 0;
            margin-bottom: 0;
            font-size: 14px;
        }

        .card {
            border: none;
            border-left: 4px solid #ffc107;
        }
    </style>
@endpush

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <h1 class="page-title">E-SDM</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="/">DataSummary</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $skpd->nama_pd }}</li>
                </ol>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title" style="font-weight: 600; letter-spacing: 0.5px;">Ringkasan Tabel -
                                    {{ $skpd->nama_pd }}</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered table-sm" style="width: 100%;">
                                        <thead style="position: sticky; top: 0; z-index: 1;">
                                            <tr style="line-height: 1.5;">
                                                <th rowspan="2" class="text-center" style="width: 35%;">NAMA JABATAN</th>
                                                <th rowspan="2" class="text-center" style="width: 5%;">KLS JBT</th>
                                                <th rowspan="2" class="text-center" style="width: 5%;">ABK IDEAL</th>
                                                <th rowspan="2" class="text-center" style="width: 6%;">KEBUTUHAN</th>
                                                <th rowspan="2" class="text-center" style="width: 5%;">PNS</th>
                                                <th rowspan="2" class="text-center" style="width: 5%;">CPNS</th>
                                                <th rowspan="2" class="text-center" style="width: 5%;">PPPK</th>
                                                <th rowspan="2" class="text-center" style="width: 5%;">NON PNS</th>
                                                <th rowspan="2" class="text-center" style="width: 5%;">JUMLAH</th>
                                                <th rowspan="2" class="text-center" style="width: 5%;">+/-</th>
                                                <th rowspan="2" class="text-center" style="width: 14%;">PEND TDK SESUAI
                                                </th>
                                                <th colspan="2" class="text-center" style="width: 5%;">BUP</th>
                                            </tr>
                                            <tr>
                                                <th>2024</th>
                                                <th>2025</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="total-row" style="line-height: 1; height: 28px;">
                                                <td class="font-weight-bold">Total Pegawai</td>
                                                <td class="text-center">{{ $totals['kelas_jabatan'] }}</td>
                                                <td class="text-center">{{ number_format($totals['abk_ideal'], 2) }}</td>
                                                <td class="text-center">{{ $totals['pemenuhan_pegawai'] }}</td>
                                                <td class="text-center">{{ $totals['pns'] }}</td>
                                                <td class="text-center">{{ $totals['cpns'] }}</td>
                                                <td class="text-center">{{ $totals['pppk'] }}</td>
                                                <td class="text-center">{{ $totals['non_pns'] }}</td>
                                                <td class="text-center">{{ $totals['jumlah_eksisting'] }}</td>
                                                <td class="text-center">
                                                    {{ $totals['jumlah_eksisting'] - $totals['pemenuhan_pegawai'] }}</td>
                                                <td class="text-center">0</td>
                                                <td></td>
                                                <td></td>
                                            </tr>

                                            {{-- MODIFIKASI LOOP DIMULAI DI SINI --}}
                                            @foreach ($flattenedHierarchy as $item)
                                                @if ($item->type === 'jabatan')
                                                    {{-- Ini adalah baris PARENT (bisa diklik) --}}
                                                    <tr id="node-jabatan-{{ $item->id }}" 
                                                        {{-- Tambahkan data-parent jika ini adalah anak dari jabatan lain --}}
                                                        @if ($item->parent_id) data-parent="node-jabatan-{{ $item->parent_id }}" @endif
                                                        {{-- Tambahkan kelas treegrid-parent dan treegrid-child (jika bukan level 1) --}}
                                                        class="treegrid-parent @if ($item->level > 1) treegrid-child @endif" 
                                                        style="background-color: #f8f9fa;">
                                                        
                                                        <td style="padding-left: {{ $item->level * 2 }}rem;">
                                                            {{-- Tambahkan Ikon Caret --}}
                                                            <i class="expand-caret fas fa-caret-right fa-fw"></i>
                                                            <strong>{{ $item->nama_jabatan }}</strong>
                                                        </td>
                                                        <td class="text-center">
                                                            <strong>{{ $item->totals['kelas_jabatan'] }}</strong></td>
                                                        <td class="text-center">
                                                            <strong>{{ number_format($item->totals['abk_ideal'], 2) }}</strong>
                                                        </td>
                                                        <td class="text-center">
                                                            <strong>{{ $item->totals['pemenuhan_pegawai'] }}</strong></td>
                                                        <td class="text-center"><strong>{{ $item->totals['pns'] }}</strong>
                                                        </td>
                                                        <td class="text-center">
                                                            <strong>{{ $item->totals['cpns'] }}</strong></td>
                                                        <td class="text-center">
                                                            <strong>{{ $item->totals['pppk'] }}</strong></td>
                                                        <td class="text-center">
                                                            <strong>{{ $item->totals['non_pns'] }}</strong></td>
                                                        <td class="text-center">
                                                            <strong>{{ $item->totals['jumlah_eksisting'] }}</strong></td>
                                                        <td class="text-center">
                                                            <strong>{{ $item->totals['jumlah_eksisting'] - $item->totals['pemenuhan_pegawai'] }}</strong>
                                                        </td>
                                                        <td class="text-center"><strong>0</strong></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                @elseif ($item->type === 'user')
                                                    {{-- Ini adalah baris CHILD (tidak bisa diklik) --}}
                                                    @php
                                                        $uraianTugas = $item->uraianTugasStaf;
                                                        $abkIdeal = $uraianTugas
                                                            ? $uraianTugas->semuaDetailTugas->sum('abk_ideal')
                                                            : 0;
                                                    @endphp
                                                    @if ($uraianTugas)
                                                        {{-- Asumsi parent_id milik user menunjuk ke id milik jabatan --}}
                                                        <tr id="node-user-{{ $item->id }}" 
                                                            data-parent="node-jabatan-{{ $item->parent_id ?? 0 }}" 
                                                            class="treegrid-child">
                                                            
                                                            <td style="padding-left: {{ $item->level * 2 }}rem;">
                                                                {{-- Tambahkan ikon "leaf" (daun) --}}
                                                                <i class="far fa-circle fa-fw leaf-icon"></i>
                                                                {{ $item->jabatan }}</td>
                                                            <td class="text-center">{{ $uraianTugas->kelas_jabatan ?? 0 }}
                                                            </td>
                                                            <td class="text-center">{{ number_format($abkIdeal, 2) }}</td>
                                                            <td class="text-center">
                                                                {{ $uraianTugas->pemenuhan_pegawai ?? 0 }}</td>
                                                            <td class="text-center">{{ $uraianTugas->pns ?? 0 }}</td>
                                                            <td class="text-center">{{ $uraianTugas->cpns ?? 0 }}</td>
                                                            <td class="text-center">{{ $uraianTugas->pppk ?? 0 }}</td>
                                                            <td class="text-center">{{ $uraianTugas->non_pns ?? 0 }}</td>
                                                            <td class="text-center">
                                                                {{ $uraianTugas->jumlah_eksisting ?? 0 }}</td>
                                                            <td class="text-center">
                                                                {{ ($uraianTugas->jumlah_eksisting ?? 0) - ($uraianTugas->pemenuhan_pegawai ?? 0) }}
                                                            </td>
                                                            <td class="text-center">0</td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                    @endif
                                                @endif
                                            @endforeach
                                            {{-- AKHIR MODIFIKASI LOOP --}}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>

    {{-- SCRIPT DARI CONTOH ANDA DITAMBAHKAN DI SINI --}}
    <script>
        $(document).ready(function() {
            $('.treegrid-parent').on('click', function(e) {
                // Hindari toggle jika yang diklik adalah link atau tombol di dalam baris
                if ($(e.target).is('a, button, input')) {
                    return;
                }

                // Dapatkan ID dari baris ini
                var parentId = $(this).attr('id');

                // Cari semua anak yang memiliki data-parent yang sesuai
                var children = $('tr[data-parent="' + parentId + '"]');

                // Toggle (sembunyikan/tampilkan) anak-anak tersebut
                children.toggle();

                // Toggle class 'expanded' pada parent untuk mengubah ikon
                $(this).toggleClass('expanded');

                // Jika kita MENUTUP (collapse), sembunyikan juga semua cucu
                if (!$(this).hasClass('expanded')) {
                    children.each(function() {
                        var childId = $(this).attr('id');
                        // Sembunyikan semua turunan dari anak ini
                        $('tr[data-parent="' + childId + '"]').hide();
                        // Pastikan ikon anak ini juga kembali ke status 'tertutup'
                        $(this).removeClass('expanded');
                    });
                }
            });
        });
    </script>
@endpush