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

        .total-row {
            background: linear-gradient(90deg, #00c6ff 0%, #0072ff 100%);
            color: white;
        }

        table thead th {
            text-align: left !important;
            vertical-align: top !important;
            padding: 10px;
        }

        /* Data Cell */
        table tbody td {
            text-align: left !important;
            vertical-align: top !important;
            border: 1px solid #ddd !important;
            /* border tiap kolom */
            color: #333;
        }

        /* Hover Effect Row */
        table tbody tr:hover {
            background-color: rgba(0, 188, 212, 0.05);
            cursor: pointer;
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

        /* Button styles */
        .btn-warning {
            background-color: #00c6ff !important;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-warning:hover {
            background-color: #0072ff !important;
            box-shadow: 0 0 10px #00c6ff;
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
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <h1 class="page-title">
                    Administrator
                </h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Staf</li>
                </ol>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @livewire('data-user.data-user-table')
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@push('scripts')
    <!-- jQuery -->
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
    <!-- Page specific script -->
    <script>
        function initializePlugins() {
            if ($.fn.DataTable.isDataTable('#example1')) {
                $('#example1').DataTable().destroy();
            }

            $('#example1').DataTable({
                "responsive": false,
                "lengthChange": true,
                "autoWidth": false,
                "scrollX": true,
                "ordering": false,
                "paging": true,
                "searching": true,
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

            if (!$('#skpd-select').data('select2')) {
                $('#skpd-select').select2({
                    placeholder: "Ketik Nama Perangkat Daerah",
                    allowClear: true
                });
            }
        }

        document.addEventListener('livewire:initialized', () => {
            initializePlugins();

            Livewire.on('plugins-reinitialized', (event) => {
                setTimeout(function() {
                    initializePlugins();
                }, 100);
            });
        });

        $(document).ready(function() {
            $('[data-widget="pushmenu"]').on('click', function() {
                setTimeout(function() {
                    $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
                }, 350);
            });
        });

        $(document).on('change', '#skpd-select', function(e) {
            var data = $(this).val();
            Livewire.dispatch('skpdSelected', {
                skpd: data
            });
        });
    </script>
@endpush
