@extends('layouts.app')

@push('styles')
    @livewireStyles
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <style>
        .btn {
            border-radius: 8px !important;
        }

        .btn-info {
            background-color: #00c6ff !important;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-info:hover {
            background-color: #0072ff !important;
            box-shadow: 0 0 10px #00c6ff;
        }

        .btn-danger:hover {
            background-color: #d50000 !important;
            box-shadow: 0 0 10px #f44336;
        }

        .btn-success {
            background-color: #4caf50 !important;
            border: none;
        }

        .btn-success:hover {
            background-color: #388e3c !important;
            box-shadow: 0 0 10px #4caf50;
        }

        .btn-group .btn {
            margin: 0 3px;
        }

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
            vertical-align: middle !important;
            font-weight: 600;
            padding: 12px 15px;
            border: 1px solid #ddd !important;
        }

        .table-bordered thead th:first-child {
            border-top-left-radius: 10px;
        }

        .table-bordered thead th:last-child {
            border-top-right-radius: 10px;
        }

        .table-bordered tbody td {
            vertical-align: middle !important;
            padding: 10px 15px;
            border: 1px solid #ddd !important;
            color: #333;
            font-size: 14px;
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

        .table-bordered tbody tr:hover {
            background-color: rgba(0, 188, 212, 0.05);
        }

        .clickable-area {
            cursor: default;
            display: flex;
            justify-content: space-between;
            align-items: center;
            min-height: 20px;
        }

        /* Update Style untuk Link Jabatan */
        .jabatan-link {
            color: inherit;
            text-decoration: none;
            transition: color 0.3s;
        }

        .jabatan-link:hover {
            color: #007bff;
            text-decoration: underline;
        }

        .add-icon {
            color: #28a745;
            font-size: 1.1em;
            cursor: pointer;
            transition: color 0.2s;
        }

        .add-icon:hover {
            color: #1e7e34;
        }

        .delete-btn {
            color: #dc3545;
            font-size: 1.1em;
            cursor: pointer;
            transition: color 0.2s;
        }

        .delete-btn:hover {
            color: #c82333;
        }

        .action-group {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        body.modal-open::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            backdrop-filter: blur(6px);
            -webkit-backdrop-filter: blur(6px);
            background: rgba(0, 0, 0, 0.3);
            z-index: 1040;
        }

        .modal-backdrop.show {
            opacity: 0 !important;
        }

        .modal-content {
            border-radius: 15px;
            background: rgba(255, 255, 255, 0.85);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }

        .modal-header {
            border-bottom: none;
            background: linear-gradient(135deg, #00c6ff 0%, #0072ff 100%);
            color: white;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }

        .modal-footer {
            border-top: none;
        }

        .modal-footer .btn-primary {
            background: #00c6ff;
            border: none;
            border-radius: 8px;
            transition: all 0.3s ease-in-out;
        }

        .modal-footer .btn-primary:hover {
            background: #0072ff;
            box-shadow: 0 0 10px #00c6ff;
        }

        .modal-footer .btn-secondary {
            border-radius: 8px;
            background-color: #f1f1f1;
            color: #333;
            border: none;
        }

        .modal-footer .btn-secondary:hover {
            background-color: #ddd;
            box-shadow: 0 0 8px #bbb;
        }
    </style>
@endpush

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="page-title">Administrator</h1>
                        <ol class="breadcrumb mt-2">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Master Struktur Jabatan</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title font-weight-bold">Data Master Struktur Jabatan</h3>
                                <div
                                    style="position:absolute;bottom:0;left:0;width:100%;height:4px;background:linear-gradient(90deg,#00c6ff,#0072ff);border-radius:5px;">
                                </div>
                                <br>
                                <div class="d-flex ">
                                    @livewire('struktur-jabatan.struktur-jabatan-form')
                                    @livewire('struktur-jabatan.struktur-jabatan-modal-excel')
                                </div>
                            </div>
                            <div class="card-body">
                                @if (session()->has('message'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <i class="fas fa-check-circle mr-2"></i>
                                        {{ session('message') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                <table class="table table-bordered table-sm" id="example1">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width:5%">No</th>
                                            <th class="text-center" style="width:15%">Perangkat Daerah (PD)</th>
                                            <th class="text-center" style="width:20%">Pimpinan Tinggi, Fungsional & Staf
                                                Ahli</th>
                                            <th class="text-center" style="width:20%">Nomenklatur Jabatan</th>
                                            <th class="text-center" style="width:20%">Kepala</th>
                                            <th class="text-center" style="width:20%">Sub Kepala</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $pdCounter = 1; @endphp
                                        @foreach ($structuredData as $pdName => $jabatans)
                                            @foreach ($jabatans as $jabatan)
                                                <tr>
                                                    <td class="text-center font-weight-bold">
                                                        {{ $loop->first ? $pdCounter . '.' : '' }}</td>
                                                    <td class="font-weight-bold">{{ $loop->first ? $pdName : '' }}</td>

                                                    @php
                                                        $isPimpinan = $jabatan->tipe_jabatan == 'Pimpinan Tinggi';

                                                        $isNomenklatur = in_array($jabatan->tipe_jabatan, [
                                                            'Nomenklatur Jabatan',
                                                            'Jabatan Fungsional',
                                                            'Staf Ahli',
                                                        ]);
                                                        $isKepala = $jabatan->tipe_jabatan == 'Kepala';
                                                        $isSubKepala = $jabatan->tipe_jabatan == 'Sub Kepala';
                                                    @endphp

                                                    {{-- KOLOM PIMPINAN TINGGI --}}
                                                    <td style="padding-left: {{ $isPimpinan ? '15px' : '0' }}">
                                                        @if ($isPimpinan)
                                                            {{-- ... (kode tampilan pimpinan tetap sama) ... --}}
                                                            <div class="clickable-area">
                                                                <span class="jabatan-name">
                                                                    <a href="{{ route('user-master', ['id_jabatan' => $jabatan->id]) }}"
                                                                        class="jabatan-link">
                                                                        <b>{{ $jabatan->nama_jabatan }}</b>
                                                                    </a>
                                                                </span>
                                                                {{-- Action buttons tetap sama --}}
                                                                <div class="action-group">
                                                                    <i class="fas fa-plus-square add-icon open-inline-modal-btn"
                                                                        title="Tambah Nomenklatur Jabatan"
                                                                        data-parent-id="{{ $jabatan->id }}"
                                                                        data-parent-name="{{ $jabatan->nama_jabatan }}"
                                                                        data-tipe-anak="Nomenklatur Jabatan"></i>
                                                                    <i class="fas fa-trash-alt delete-btn delete-btn-js ms-2"
                                                                        data-id="{{ $jabatan->id }}"></i>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </td>

                                                    {{-- KOLOM NOMENKLATUR (Sekarang termasuk Fungsional & Staf Ahli) --}}
                                                    <td style="padding-left: {{ $isNomenklatur ? '15px' : '0' }}">
                                                        @if ($isNomenklatur)
                                                            <div class="clickable-area">
                                                                <span class="jabatan-name">
                                                                    <a href="{{ route('user-master', ['id_jabatan' => $jabatan->id]) }}"
                                                                        class="jabatan-link">
                                                                        <b>{{ $jabatan->nama_jabatan }}</b>
                                                                    </a>
                                                                </span>
                                                                <div class="action-group">
                                                                    {{-- Logic tombol tambah anak --}}
                                                                    <i class="fas fa-plus-square add-icon open-inline-modal-btn"
                                                                        title="Tambah Kepala"
                                                                        data-parent-id="{{ $jabatan->id }}"
                                                                        data-parent-name="{{ $jabatan->nama_jabatan }}"
                                                                        data-tipe-anak="Kepala"></i>
                                                                    <i class="fas fa-trash-alt delete-btn delete-btn-js ms-2"
                                                                        data-id="{{ $jabatan->id }}"></i>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </td>

                                                    {{-- KOLOM KEPALA --}}
                                                    <td style="padding-left: {{ $isKepala ? '15px' : '0' }}">
                                                        @if ($isKepala)
                                                            <div class="clickable-area">
                                                                <span class="jabatan-name">
                                                                    {{-- PERUBAHAN: Menambahkan link --}}
                                                                    <a href="{{ route('user-master', ['id_jabatan' => $jabatan->id]) }}"
                                                                        class="jabatan-link" title="Klik untuk lihat user">
                                                                        <b>{{ $jabatan->nama_jabatan }}</b>
                                                                    </a>
                                                                </span>
                                                                <div class="action-group">
                                                                    <i class="fas fa-plus-square add-icon open-inline-modal-btn"
                                                                        title="Tambah Sub Kepala"
                                                                        data-parent-id="{{ $jabatan->id }}"
                                                                        data-parent-name="{{ $jabatan->nama_jabatan }}"
                                                                        data-tipe-anak="Sub Kepala"></i>
                                                                    <i class="fas fa-trash-alt delete-btn delete-btn-js ms-2"
                                                                        title="Hapus Jabatan"
                                                                        data-id="{{ $jabatan->id }}"></i>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </td>

                                                    {{-- KOLOM SUB KEPALA --}}
                                                    <td style="padding-left: {{ $isSubKepala ? '15px' : '0' }}">
                                                        @if ($isSubKepala)
                                                            <div class="clickable-area">
                                                                <span class="jabatan-name">
                                                                    {{-- PERUBAHAN: Menambahkan link --}}
                                                                    <a href="{{ route('user-master', ['id_jabatan' => $jabatan->id]) }}"
                                                                        class="jabatan-link"
                                                                        title="Klik untuk lihat user">
                                                                        <b>{{ $jabatan->nama_jabatan }}</b>
                                                                    </a>
                                                                </span>
                                                                <div class="action-group">
                                                                    {{-- Sub Kepala tidak ada tombol tambah turunan --}}
                                                                    <i class="fas fa-trash-alt delete-btn delete-btn-js ms-2"
                                                                        title="Hapus Jabatan"
                                                                        data-id="{{ $jabatan->id }}"></i>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                            @php $pdCounter++; @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @livewire('struktur-jabatan.struktur-jabatan-inline-form')
        @livewire('struktur-jabatan.delete-modal')

    </div>
@endsection

@push('scripts')
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function initDataTables() {
            if ($.fn.DataTable.isDataTable('#example1')) {
                $('#example1').DataTable().destroy();
            }
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "paging": true,
                "searching": true,
                "ordering": false,
                "info": false
            });
        }

        document.addEventListener('livewire:initialized', () => {
            initDataTables();

            $('#id_pd').select2({
                theme: 'bootstrap4',
                placeholder: "-- Pilih PD --",
                dropdownParent: $('#addJabatanModal')
            });

            $('#idPdImport').select2({
                theme: 'bootstrap4',
                placeholder: "-- Pilih PD --",
                dropdownParent: $('#impor-excel')
            });

            $('#id_pd').on('change', function(e) {
                Livewire.dispatch('pdSelected', {
                    pdId: $(this).val()
                });
            });

            $('#idPdImport').on('change', function(e) {
                Livewire.dispatch('pdImportSelected', {
                    pdId: $(this).val()
                });
            });

            Livewire.on('refresh-struktur-jabatan-table', () => {
                setTimeout(() => initDataTables(), 100);
            });

            Livewire.on('close-import-struktur-jabatan-modal', () => {
                $('#impor-excel').modal('hide');
            });

            Livewire.on('close-inline-modal', () => {
                $('#addJabatanInlineModal').modal('hide');
                $('#idPdImport').val(null).trigger('change');
            });

            Livewire.on('close-modal', () => {
                $('#addJabatanModal').modal('hide');
                $('#id_pd').val(null).trigger('change');
            });

            Livewire.on('import-success', data => {
                Swal.fire({
                    icon: 'success',
                    title: data.title || 'Import Berhasil!',
                    text: data.message || 'Data telah berhasil diproses.',
                    timer: 2500,
                    showConfirmButton: false
                });
            });

            Livewire.on('import-error', data => {
                Swal.fire({
                    icon: 'error',
                    title: data.title || 'Error',
                    html: data.message || 'Terjadi kesalahan.',
                    width: '800px',
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Saya Mengerti'
                });
            });

            Livewire.on('delete-success', data => {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil Dihapus!',
                    text: data.message,
                    timer: 2500,
                    showConfirmButton: false
                });
            });

            Livewire.on('show-delete-confirmation-modal', () => {
                $('#deleteJabatanModal').modal('show');
            });
            Livewire.on('hide-delete-confirmation-modal', () => {
                $('#deleteJabatanModal').modal('hide');
            });
        });

        $(document).on('click', '#example1 .open-inline-modal-btn', function() {
            const parentId = $(this).data('parent-id');
            const parentName = $(this).data('parent-name');
            const tipeAnak = $(this).data('tipe-anak');

            Livewire.dispatch('open-inline-add-modal', {
                parentId: parentId,
                parentName: parentName,
                tipeAnak: tipeAnak
            });

            $('#addJabatanInlineModal').modal('show');
        });

        $(document).on('click', '#example1 .delete-btn-js', function() {
            const jabatanId = $(this).data('id');

            Livewire.dispatch('open-delete-modal', {
                id: jabatanId
            });
        });
    </script>
@endpush
