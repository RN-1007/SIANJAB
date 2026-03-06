@extends('layouts.app')

@push('styles')
    @livewireStyles
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
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

        /* Specific style for background rows */
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
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Data Staf</li>
                        </ol>
                    </div>
                </div>
            </div></section>

        <section class="content">
            <div class="container-fluid">

                @livewire('data-staf.data-staf-table')

                @livewire('data-staf.edit-pemenuhan-pegawai-modal')

            </div>
            </section>
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
    <script>
        function initializeDataTable() {
            // ... (Fungsi ini sudah benar, tidak perlu diubah)
            if ($.fn.DataTable.isDataTable('#example1')) {
                $('#example1').DataTable().destroy();
            }
            if ($('#example1').length) {
                $("#example1").DataTable({
                    "responsive": false,
                    "lengthChange": true,
                    "autoWidth": false,
                    "paging": false,
                    "searching": false,
                    "ordering": false,
                    "info": false,
                    "scrollX": true
                });
            }
        }

        function initializePageScripts() {
            $('#skpd-select').select2({
                placeholder: "Ketik untuk mencari PD",
                allowClear: true,
                theme: 'bootstrap4',
                dropdownCssClass: "select2-dropdown-open"
            });
            
            // Menambahkan event listener untuk mengatur fokus otomatis saat dropdown dibuka
            $('#skpd-select').on('select2:open', function() {
                setTimeout(function() {
                    $('.select2-search__field').focus();
                }, 0);
            });

            $('#skpd-select').off('change').on('change', function(e) {
                let data = $(this).val();
                window.Livewire.dispatch('skpdSelected', {
                    skpd: data
                });
            });

            window.Livewire.on('open-modal', event => {
                $('#' + event.name).modal('show');
            });
            window.Livewire.on('close-modal', event => {
                $('#' + event.name).modal('hide');
            });
        }

        document.addEventListener('livewire:init', () => {
            initializePageScripts();
            initializeDataTable();

            Livewire.hook('message.processed', (message, component) => {
                initializeDataTable();
            });

            window.Livewire.on('skpd-updated', (event) => {
                const selectElement = $('#skpd-select');

                if (selectElement.val() != event.skpdId) {
                    selectElement.val(event.skpdId).trigger('change');
                }
            });
        });

        window.addEventListener('pageshow', event => {
            if (event.persisted) {
                console.log('Page restored from bfcache. Re-initializing scripts.');
                initializePageScripts();
            }
        });
    </script>
@endpush