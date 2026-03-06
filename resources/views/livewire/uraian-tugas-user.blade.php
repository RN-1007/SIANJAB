@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">

    <style>
        table thead tr {
            background: linear-gradient(90deg, #00c6ff 0%, #0072ff 100%) !important;
            color: #fff !important;
        }

        table thead th {
            vertical-align: top !important;
            padding: 10px;
            border: 1px solid #ddd !important;
        }

        /* Data Cell */
        table tbody td {
            vertical-align: top !important;
            padding: 8px 10px;
            border: 1px solid #ddd !important;
        }

        /* Hover Effect Row */
        table tbody tr:hover {
            background-color: rgba(0, 188, 212, 0.05);
        }

        /* Table rounded */
        table {
            border-collapse: separate !important;
            border-spacing: 0;
            border-radius: 10px;
            overflow: hidden;
        }

        /* Rounded only at top */
        table thead th:first-child {
            border-top-left-radius: 10px;
        }

        table thead th:last-child {
            border-top-right-radius: 10px;
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

        /* Futuristic Buttons */
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

        /* Button rounded + spacing */
        .btn {
            border-radius: 8px !important;
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
            /* semi dark overlay */
            z-index: 1040;
            /* below modal */
        }

        /* Pastikan backdrop asli dihilangkan warnanya */
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

        .dot {
            width: 16px;
            height: 16px;
            border-radius: 50%;
            animation: bounce 1.4s infinite ease-in-out both;
        }

        .delay-1 {
            animation-delay: 0.2s;
        }

        .delay-2 {
            animation-delay: 0.4s;
        }

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

        #global-loader {
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        #global-loader.show {
            display: flex !important;
            opacity: 1;
            pointer-events: all;
        }
    </style>
@endpush

@section('content')
    <div>
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <h1 class="page-title">
                        Administrator
                    </h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Administrator</li>
                    </ol>
                </div>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    @livewire('uraian-tugas-user.uraian-tugas-table3')
                    <!-- /.row -->
                </div>

                {{-- Untuk Uraian Tugas Yang Sudah Di Aprove Oleh Admin --}}
                <!-- /.container-fluid -->
                <div class="container-fluid">
                    @livewire('uraian-tugas-user.uraian-tugas-table1')
                    <!-- /.row -->
                </div>

                {{-- Unrtuk Uraian Tugas Yang Belum Di Approve Oleh Admin --}}
                <!-- /.container-fluid -->
                <div class="container-fluid">
                    @livewire('uraian-tugas-user.uraian-tugas-table2')
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->

                <!-- Modal Data Pendukung -->
                @livewire('uraian-tugas-user.data-pendukung-modal')

                <!-- Modal Data Pendukung -->
                @livewire('uraian-tugas-user.rincian-tugas-user-modal')

                {{-- Modal Edit Data Uraian Tugas --}}
                @livewire('uraian-tugas-user.edit-uraian-tugas-modal')

                {{-- Global Loading Overlay untuk Modal Actions --}}
                @livewire('uraian-tugas-user.animasi-loading-modal')

                {{-- Modal Hapus Uraian Tugas --}}
                @livewire('uraian-tugas-user.hapus-uraian-tugas-modal')
            </section>
            <!-- /.content -->
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function showLoader() {
            $('#global-loader').addClass('show').css('display', 'flex');
        }

        function hideLoader(callback) {
            $('#global-loader').removeClass('show');
            setTimeout(function() {
                $('#global-loader').css('display', 'none');
                if (callback) callback();
            }, 300);
        }

        function openModalWithLoader(modalId) {
            showLoader();

            setTimeout(function() {
                hideLoader(function() {
                    $(modalId).modal('show');
                });

            }, 600);
        }

        $(document).ready(function() {
            $('[data-widget="pushmenu"]').on('click', function() {
                setTimeout(function() {
                    $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
                }, 350);
            });

            $(window).on('resize', function() {
                $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
            });
        });

        function initializeDataTables() {
            if ($.fn.DataTable.isDataTable('#example1')) {
                $('#example1').DataTable().destroy();
            }
            if ($.fn.DataTable.isDataTable('#example2')) {
                $('#example2').DataTable().destroy();
            }
            if ($.fn.DataTable.isDataTable('#example3')) {
                $('#example3').DataTable().destroy();
            }

            // Inisialisasi ulang DataTable
            $("#example1").DataTable({
                scrollX: true,
                lengthChange: true,
                paging: true,
                autoWidth: false,
                ordering: false,
                fixedColumns: false,
                responsive: false,
                searching: true
            });
            $('#example2').DataTable({
                scrollX: true,
                autoWidth: false,
                paging: true,
                lengthChange: true,
                ordering: false,
                fixedColumns: false,
                responsive: false,
                searching: true
            });
            $('#example3').DataTable({
                scrollX: true,
                autoWidth: false,
                paging: true,
                lengthChange: true,
                ordering: false,
                fixedColumns: false,
                responsive: false,
                searching: true
            });
        }

        document.addEventListener('livewire:initialized', () => {
            initializeDataTables();

            const refreshEvents = ['uraianTugasCreatedTable1', 'uraianTugasCreatedTable2',
                'uraianTugasCreatedTable3'
            ];
            refreshEvents.forEach(eventName => {
                Livewire.on(eventName, () => {
                    console.log(`Event ${eventName} diterima, me-refresh semua DataTables...`);
                    setTimeout(initializeDataTables, 150);
                });
            });

            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });

            Livewire.on('open-data-pendukung-modal', () => {
                openModalWithLoader('#data-pendukung');
            });
            Livewire.on('close-data-pendukung-modal', () => {
                $('#data-pendukung').modal('hide');
            });
            Livewire.on('open-create-modal', () => {
                openModalWithLoader('#tambah-tugas');
            });
            Livewire.on('close-create-modal', () => {
                $('#tambah-tugas').modal('hide');
            });
            Livewire.on('open-rincian-tugas-modal', () => {
                openModalWithLoader('#rincianTugasModal');
            });
            Livewire.on('open-edit-tugas-modal', () => {
                openModalWithLoader('#edit-tugas-staf');
            });
            Livewire.on('close-edit-tugas-modal', () => {
                $('#edit-tugas-staf').modal('hide');
            });
            Livewire.on('open-delete-modal-event', () => {
                openModalWithLoader('#deleteUraianTugasModal');
            });
            Livewire.on('close-delete-modal-event', () => {
                $('#deleteUraianTugasModal').modal('hide');
            });
            Livewire.on('show-success', (event) => {
                Toast.fire({
                    icon: 'success',
                    title: event.message
                })
            });
            Livewire.on('show-error', (event) => {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: event.message,
                });
            });
        });

        $(document).ready(function() {
            $('#inputType').on('change', function() {
                const selected = $(this).val();
                if (selected === 'link') {
                    $('#link-group').show();
                    $('#file-group').hide();
                } else if (selected === 'file') {
                    $('#file-group').show();
                    $('#link-group').hide();
                } else {
                    $('#link-group').hide();
                    $('#file-group').hide();
                }
            });

            // Reset input & selection saat modal ditutup
            $('#modal-default').on('hidden.bs.modal', function() {
                $('#inputType').val('');
                $('#link-input').val('');
                $('#exampleInputFile').val('');
                $('.custom-file-label').text('Choose file');
                $('#link-group').hide();
                $('#file-group').hide();
            });

            // Update label nama file saat file dipilih
            $('#exampleInputFile').on('change', function() {
                const fileName = $(this).val().split('\\').pop();
                $(this).next('.custom-file-label').addClass("selected").html(fileName);
            });
        });
    </script>
@endpush
