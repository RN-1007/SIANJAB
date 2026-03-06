@extends('layouts.app')

@push('styles')
    @livewireStyles
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    
    <style>
        table thead tr {
            background: linear-gradient(90deg, #00c6ff 0%, #0072ff 100%) !important;
            color: #fff !important;
        }

        table thead th {
            text-align: left !important;
            vertical-align: top !important;
            font-weight: 600;
            padding: 10px;
            border: 1px solid #ddd !important;
        }

        table tbody td {
            text-align: left !important;
            vertical-align: top !important;
            padding: 8px 10px;
            border: 1px solid #ddd !important;
            color: #333;
            font-size: 13px;
        }

        table tbody tr:hover {
            background-color: rgba(0, 188, 212, 0.05);
            cursor: pointer;
        }

        table {
            border-collapse: separate !important;
            border-spacing: 0;
            border-radius: 10px;
            overflow: hidden;
        }

        table thead th:first-child {
            border-top-left-radius: 10px;
        }

        table thead th:last-child {
            border-top-right-radius: 10px;
        }

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
        
        .select2-container--open {
            z-index: 99999 !important;
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
                            <li class="breadcrumb-item active">Data Master Uraian Tugas</li>
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
                                <h3 class="card-title font-weight-bold">Data Master Uraian Tugas</h3>
                                <div
                                    style="position:absolute;bottom:0;left:0;width:100%;height:4px;background:linear-gradient(90deg,#00c6ff,#0072ff);border-radius:5px;">
                                </div>
                                <br>
                                <div class="d-flex">
                                    @livewire('data-uraian-tugas.data-uraian-tugas-form')
                                </div>
                            </div>
                            <div class="card-body">
                                @livewire('data-uraian-tugas.data-uraian-tugas-table')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

{{-- 
================================================================
PERBAIKAN UTAMA ADA DI DALAM BLOK @push('scripts') DI BAWAH INI
================================================================
--}}
@push('scripts')
    {{-- (Aset JS Anda) --}}
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('dist/js/demo.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>


    <script>
        // Variabel global untuk menampung ID user sementara saat edit
        let editUserIdToSet = null;

        function initializeDataTables() {
            // Hancurkan tabel lama jika ada agar tidak duplikat
            if ($.fn.DataTable.isDataTable('#example1')) {
                $('#example1').DataTable().destroy();
            }

            // Buat tabel baru
            $("#example1").DataTable({
                responsive: true,
                lengthChange: true,
                autoWidth: false,
                ordering: false,
                searching: true,
                paging: true,
                info: true,
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        }

        // Fungsi Init Select2 Modal Tambah
        function initializeAddSelect2() {
             $('#id_user_select').select2({
                theme: 'bootstrap4',
                placeholder: "-- Pilih Jabatan --",
                dropdownParent: $('#modal-tambah')
            });

            $('#id_user_select').on('change', function(e) {
                var data = $(this).val();
                Livewire.dispatch('userIdChanged', { id: data });
            });
        }

        document.addEventListener('livewire:initialized', () => {
            // 1. Init awal saat halaman dibuka
            initializeDataTables();
            initializeAddSelect2();

            // 2. Listener khusus untuk Refresh Tabel setelah Save/Update/Delete
            Livewire.on('refresh-data-uraian-tugas-table', () => {
                // Beri jeda 100ms agar HTML tabel selesai dirender ulang oleh Livewire
                // sebelum DataTables dipasang kembali
                setTimeout(() => {
                    initializeDataTables();
                    initializeAddSelect2();
                }, 100);
            });

            // --- Listener Modal & Form ---
            
            // Listener Edit: Simpan data ID user
            window.addEventListener('set-edit-user-data', (event) => {
                const data = event.detail[0];
                editUserIdToSet = data.id_user;
            });

            // Listener Modal Edit Terbuka
            window.addEventListener('open-edit-modal', (event) => {
                $('#modal-edit-uraian-tugas').modal('show');
            });

            // Logika Select2 di dalam Modal Edit (dijalankan saat modal benar-benar tampil)
            $('#modal-edit-uraian-tugas').on('shown.bs.modal', function () {
                // Bersihkan dulu
                if ($('#select-id-user-edit').data('select2')) {
                    $('#select-id-user-edit').select2('destroy');
                }

                // Set nilai awal dari variabel sementara
                if (editUserIdToSet) {
                    $('#select-id-user-edit').val(editUserIdToSet);
                }

                // Init Select2
                $('#select-id-user-edit').select2({
                    theme: 'bootstrap4',
                    dropdownParent: $('#modal-edit-uraian-tugas'), 
                    minimumResultsForSearch: Infinity
                });

                // Listener perubahan
                $('#select-id-user-edit').off('change').on('change', function (e) {
                    Livewire.dispatch('set-id-user-from-js', { id_user: $(this).val() });
                });

                // Trigger manual agar tampilan update
                if (editUserIdToSet) {
                     $('#select-id-user-edit').trigger('change');
                }
            });

            // Listener Tutup Modal
            Livewire.on('close-modal', () => {
                $('#modal-tambah').modal('hide');
                $('#id_user_select').val(null).trigger('change'); // Reset form tambah
            });
            
            Livewire.on('close-edit-modal', () => {
                $('#modal-edit-uraian-tugas').modal('hide');
                editUserIdToSet = null;
            });

            // Listener Delete
            window.addEventListener('open-delete-modal', () => {
                $('#modal-delete').modal('show');
            });
            window.addEventListener('close-delete-modal', () => {
                $('#modal-delete').modal('hide');
            });
        });
    </script>
@endpush