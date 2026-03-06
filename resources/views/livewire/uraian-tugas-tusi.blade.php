@extends('layouts.app')

@push('styles')
    <!-- CSS -->
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
                            <li class="breadcrumb-item active">Data Master Setting Tusi</li>
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
                                <h3 class="card-title font-weight-bold">Data Master Setting Tusi</h3>
                                <div
                                    style="position:absolute;bottom:0;left:0;width:100%;height:4px;background:linear-gradient(90deg,#00c6ff,#0072ff);border-radius:5px;">
                                </div>
                                <br>
                                <div class="d-flex">
                                    @livewire('uraian-tugas-tusi.uraian-tugas-tusi-form')

                                    <button type="button" data-toggle="modal" data-target="#modal-import-tusi"
                                        class="mt-2 btn btn-sm btn-success ml-2">
                                        <i class="fas fa-file-import"></i> Import Data
                                    </button>

                                    @livewire('uraian-tugas-tusi.uraian-tugas-tusi-modal-excel')
                                </div>
                            </div>
                            <div class="card-body">
                                @livewire('uraian-tugas-tusi.uraian-tugas-tusi-table')
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
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function initializeDataTables() {
            if ($.fn.DataTable.isDataTable('#example1')) {
                $('#example1').DataTable().destroy();
            }
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

        function initializeAddModalSelect2() {
            // --- 1. SETUP Select2 Jabatan ---
            $('#id_uraian_tugas_staf').select2({
                theme: 'bootstrap4',
                placeholder: "Pilih Jabatan Staf",
                dropdownParent: $('#addModal')
            });

            // Event Listener
            $('#id_uraian_tugas_staf').on('change', function(e) {
                var data = $(this).val();

                // Perintah ini akan memanggil fungsi setUraianTugasStaf($id) di PHP
                // Sesuai dengan #[On('uraianTugasStafChanged')]
                Livewire.dispatch('uraianTugasStafChanged', {
                    id: data
                });
            });

            // --- 2. SETUP Select2 Tusi ---
            $('#id_tusi').select2({
                theme: 'bootstrap4',
                placeholder: "Pilih Tugas dan Fungsi",
                dropdownParent: $('#addModal')
            });

            // Event Listener
            $('#id_tusi').on('change', function(e) {
                var data = $(this).val();

                // Perintah ini akan memanggil fungsi setTusi($id) di PHP
                // Sesuai dengan #[On('tusiChanged')]
                Livewire.dispatch('tusiChanged', {
                    id: data
                });
            });
        }

        // Fungsi ini hanya untuk Select2 di Modal Edit
        function initializeEditModalSelect2() {
            // --- 1. SETUP Select2 Jabatan (EDIT) ---
            $('#edit_id_uraian_tugas_staf').select2({
                theme: 'bootstrap4',
                placeholder: "Pilih Jabatan Staf",
                dropdownParent: $('#editModal')
            });

            // Event Listener: Kirim data ke PHP saat berubah
            $('#edit_id_uraian_tugas_staf').on('change', function(e) {
                var data = $(this).val();
                // Sesuai dengan #[On('editUraianTugasStafChanged')] di PHP
                Livewire.dispatch('editUraianTugasStafChanged', {
                    id: data
                });
            });

            // --- 2. SETUP Select2 Tusi (EDIT) ---
            $('#edit_id_tusi').select2({
                theme: 'bootstrap4',
                placeholder: "Pilih Tugas dan Fungsi",
                dropdownParent: $('#editModal')
            });

            // Event Listener: Kirim data ke PHP saat berubah
            $('#edit_id_tusi').on('change', function(e) {
                var data = $(this).val();
                // Sesuai dengan #[On('editTusiChanged')] di PHP
                Livewire.dispatch('editTusiChanged', {
                    id: data
                });
            });
        }

        document.addEventListener('livewire:initialized', () => {
            initializeDataTables();
            // Inisialisasi kedua modal Select2 saat halaman dimuat pertama kali
            initializeAddModalSelect2();
            initializeEditModalSelect2();

            // --- Listener untuk Select2 ---

            window.addEventListener('reset-selects', event => {
                $('#id_uraian_tugas_staf').val(null).trigger('change');
                $('#id_tusi').val(null).trigger('change');
            });

            window.addEventListener('set-edit-data', event => {
                const data = event.detail[0];
                $('#edit_id_uraian_tugas_staf').val(data.uraianTugasStafId).trigger('change.select2');
                $('#edit_id_tusi').val(data.tusiId).trigger('change.select2');
            });

            window.addEventListener('reset-edit-selects', event => {
                $('#edit_id_uraian_tugas_staf').val(null).trigger('change.select2');
                $('#edit_id_tusi').val(null).trigger('change.select2');
            });

            // --- Listener untuk DataTables ---

            // PERBAIKAN UTAMA:
            // Kita tidak lagi memanggil initializeSelect2() di sini.
            // Modal Add & Edit ada di luar tabel, jadi
            // Select2-nya tidak perlu di-inisialisasi ulang saat tabel refresh.
            Livewire.on('setting-tusi-table-updated', () => {
                setTimeout(() => initializeDataTables(), 100);
            });

            // --- Listener untuk Modal ---
            Livewire.on('close-modal', () => {
                $('#addModal').modal('hide');
                $('#editModal').modal('hide');
                Livewire.dispatch('reset-selects');
            });

            Livewire.on('open-edit-modal', () => {
                $('#editModal').modal('show');
            });

            Livewire.on('close-edit-modal', () => {
                $('#editModal').modal('hide');
                Livewire.dispatch('reset-edit-selects');
            });

            Livewire.on('open-delete-modal', () => {
                $('#modal-delete').modal('show');
            });

            Livewire.on('close-delete-modal', () => {
                $('#modal-delete').modal('hide');
            });

            Livewire.on('close-import-tusi-modal', () => {
                $('#modal-import-tusi').modal('hide');
            });

            // --- Listener Notifikasi (SweetAlert) ---

            window.addEventListener('import-success', event => {
                const data = event.detail[0];
                Swal.fire({
                    icon: 'success',
                    title: data.title,
                    text: data.message,
                    timer: 2500,
                    showConfirmButton: false
                });
            });

            window.addEventListener('import-error', event => {
                const data = event.detail[0];
                Swal.fire({
                    icon: 'error',
                    title: data.title,
                    html: data.message,
                    width: '800px',
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Saya Mengerti'
                });
            });

        });
    </script>
@endpush
