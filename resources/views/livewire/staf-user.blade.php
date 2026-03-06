@extends('layouts.app')

@push('styles')
    @livewireStyles
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <style>
        .table-layout-fixed {
            table-layout: fixed;
            width: 100%;
        }

        .table-layout-fixed th,
        .table-layout-fixed td {
            word-wrap: break-word;
            /* Memaksa teks turun jika terlalu panjang */
            overflow-wrap: break-word;
            white-space: normal !important;
            /* Memastikan spasi dan baris baru bekerja normal */
        }

        /* Header Table - Gradient Futuristik + Border */
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
            /* border tiap kolom */
        }

        /* Data Cell */
        table tbody td {
            text-align: left !important;
            vertical-align: top !important;
            padding: 8px 10px;
            border: 1px solid #ddd !important;
            /* border tiap kolom */
            color: #180c0c;
            /* font-size: 13px; */
        }

        /* Hover Effect Row */
        table tbody tr:hover {
            background-color: rgba(0, 188, 212, 0.05);
            /* cursor: pointer; */
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

        /* Checkbox column styling */
        .checkbox-column {
            width: 60px !important;
            text-align: center !important;
        }

        .checkbox-column input[type="checkbox"] {
            transform: scale(1.2);
            cursor: pointer;
        }

        /* Action column styling */
        .action-column {
            width: 120px !important;
            text-align: center !important;
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

        .btn-warning {
            background-color: #ff9800 !important;
            border: none;
        }

        .btn-warning:hover {
            background-color: #f57c00 !important;
            box-shadow: 0 0 10px #ff9800;
        }

        /* Button rounded + spacing */
        .btn {
            border-radius: 8px !important;
        }

        .btn-group .btn {
            margin: 0 3px;
        }

        /* Small action buttons for table */
        .btn-sm {
            padding: 4px 8px;
            font-size: 12px;
            margin: 1px;
        }

        /* Fix table alignment issues */
        #example1, #example2 {
            table-layout: fixed;
        }
        
        #example1 th, #example1 td,
        #example2 th, #example2 td {
            vertical-align: middle;
            text-align: left;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }
        
        #example1 th.text-center, #example1 td.text-center,
        #example2 th.text-center, #example2 td.text-center {
            text-align: center;
        }
        
        /* Ensure checkbox columns are properly aligned */
        .checkbox-column {
            text-align: center !important;
            vertical-align: middle !important;
        }
        
        .action-column {
            text-align: center !important;
            vertical-align: middle !important;
        }

        /* Force backdrop blur saat modal aktif */
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

        /* Success Modal Styling */
        #successModal .modal-content {
            border-radius: 15px;
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        #successModal .modal-body {
            padding: 2rem;
        }

        #successModal .fa-check-circle {
            color: #28a745;
            animation: scaleIn 0.3s ease-in-out;
        }

        @keyframes scaleIn {
            from {
                transform: scale(0);
            }

            to {
                transform: scale(1);
            }
        }

        #successModal .btn-secondary {
            border-radius: 20px;
            padding: 8px 20px;
            background: #f8f9fa;
            color: #333;
            border: none;
            transition: all 0.3s ease;
        }

        #successModal .btn-secondary:hover {
            background: #e2e6ea;
            transform: translateY(-1px);
        }

        /* Select all checkbox in header */
        .select-all-checkbox {
            transform: scale(1.3);
            cursor: pointer;
        }

        /* Bulk action controls */
        .bulk-action-controls {
            margin-bottom: 15px;
            padding: 10px 15px;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 8px;
            border-left: 4px solid #00c6ff;
            display: none;
        }

        .bulk-action-controls.show {
            display: block;
            animation: slideDown 0.3s ease-in-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .bulk-action-controls .selected-count {
            font-weight: 600;
            color: #00c6ff;
            margin-right: 15px;
        }
    </style>
@endpush

@section('content')
    <div>
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <h1 class="page-title">
                        {{ $namaJabatanStaf }}
                    </h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Struktural</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Staf</li>
                    </ol>
                </div>
            </section>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header" style="position: relative; padding-bottom: 10px;">
                                    <h3 class="card-title" style="font-weight: 600; letter-spacing: 0.5px;">
                                        <i class="fas fa-check-circle mr-2 text-success"></i> Data Uraian Tugas Staf Yang
                                        Sudah Diterima
                                    </h3>
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

                                <div class="card-body" style="overflow-x: auto;">
                                    @livewire('staf-user.staf-user-table1', ['jabatanStafId' => $jabatanStafId ?? null])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header" style="position: relative; padding-bottom: 10px;">
                                    <h3 class="card-title" style="font-weight: 600; letter-spacing: 0.5px;">
                                        <i class="fas fa-exclamation-triangle mr-2 text-warning"></i> Data Uraian Tugas Staf
                                        Yang Belum Diterima
                                    </h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                    <div
                                        style="
                                        position: absolute;
                                        bottom: 0;
                                        left: 0;
                                        width: 100% ;
                                        height: 4px;
                                        background: linear-gradient(90deg, #ffc107, #fd7e14);
                                        border-radius: 5px;">
                                    </div>
                                </div>
                                <div class="card-body" style="overflow-x: auto;">
                                    @livewire('staf-user.staf-user-table2', ['jabatanStafId' => $jabatanStafId ?? null])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <div wire:ignore.self class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Konfirmasi Hapus</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="button" wire:click="destroy" class="btn btn-danger">Hapus</button>
                    </div>
                </div>
            </div>
        </div>

        @livewire('staf-user.staf-data-pendukung-modal')
    </div>
@endsection

@push('scripts')
    {{-- 1. Pustaka Pihak Ketiga (Vendor Libraries) --}}
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

    {{-- 2. Skrip Kustom Aplikasi --}}
    <script>
        function initializeDataTables() {
            // Hancurkan instance DataTables yang ada untuk menghindari konflik
            if ($.fn.DataTable.isDataTable('#example1')) {
                $('#example1').DataTable().destroy();
            }
            if ($.fn.DataTable.isDataTable('#example2')) {
                $('#example2').DataTable().destroy();
            }

            // Cek apakah tabel ada di DOM sebelum inisialisasi
            if ($('#example1').length) {
                $("#example1").DataTable({
                    "responsive": false, // Disable responsive untuk scrollX
                    "lengthChange": true,
                    "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "Semua"] ],
                    "autoWidth": false,
                    "searching": true,
                    "paging": true,
                    "ordering": false,
                    "scrollX": true, // Enable horizontal scroll untuk tabel lebar
                    "info": true,
                    "columnDefs": [
                        { "orderable": false, "targets": [-1, -2] }, // Disable ordering for checkbox and action columns
                        { "className": "checkbox-column", "targets": [-2] }, // Apply checkbox styling to second last column
                        { "className": "action-column", "targets": [-1] } // Apply action styling to last column
                    ],
                    "stateSave": false // Disable state saving untuk mencegah konflik
                });
            }

            if ($('#example2').length) {
                $("#example2").DataTable({
                    "responsive": false, // Disable responsive untuk scrollX
                    "lengthChange": true,
                    "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "Semua"] ],
                    "autoWidth": false,
                    "searching": true,
                    "paging": true,
                    "ordering": false,
                    "scrollX": true, // Enable horizontal scroll untuk tabel lebar
                    "info": true,
                    "columnDefs": [
                        { "orderable": false, "targets": [-1, -2] }, // Disable ordering for checkbox and action columns
                        { "className": "checkbox-column", "targets": [-2] }, // Apply checkbox styling to second last column
                        { "className": "action-column", "targets": [-1] } // Apply action styling to last column
                    ],
                    "stateSave": false // Disable state saving untuk mencegah konflik
                });
            }
        }

        // Bulk action functionality
        function handleBulkActions() {
            // Select/Deselect all checkboxes
            $(document).on('change', '.select-all-checkbox', function() {
                const isChecked = $(this).is(':checked');
                const tableId = $(this).closest('table').attr('id');
                $(`#${tableId} .row-checkbox`).prop('checked', isChecked);
                updateBulkActionControls(tableId);
            });

            // Handle individual row checkbox
            $(document).on('change', '.row-checkbox', function() {
                const tableId = $(this).closest('table').attr('id');
                const totalCheckboxes = $(`#${tableId} .row-checkbox`).length;
                const checkedCheckboxes = $(`#${tableId} .row-checkbox:checked`).length;
                
                // Update select all checkbox state
                const selectAllCheckbox = $(`#${tableId} .select-all-checkbox`);
                if (checkedCheckboxes === 0) {
                    selectAllCheckbox.prop('indeterminate', false).prop('checked', false);
                } else if (checkedCheckboxes === totalCheckboxes) {
                    selectAllCheckbox.prop('indeterminate', false).prop('checked', true);
                } else {
                    selectAllCheckbox.prop('indeterminate', true);
                }

                updateBulkActionControls(tableId);
            });
        }

        function updateBulkActionControls(tableId) {
            const checkedCheckboxes = $(`#${tableId} .row-checkbox:checked`).length;
            const bulkControls = $(`#${tableId}`).closest('.card-body').find('.bulk-action-controls');
            
            if (checkedCheckboxes > 0) {
                bulkControls.addClass('show');
                bulkControls.find('.selected-count').text(`${checkedCheckboxes} item terpilih`);
            } else {
                bulkControls.removeClass('show');
            }
        }

        document.addEventListener('livewire:initialized', () => {
            initializeDataTables();
            handleBulkActions();
            
            Livewire.hook('message.processed', (message, component) => {
                setTimeout(() => {
                    initializeDataTables();
                }, 200);
            });

            // Reinitialize DataTables after modal interactions
            Livewire.on('refreshDataTables', () => {
                setTimeout(() => {
                    initializeDataTables();
                }, 100);
            });

            /**
             * Fungsi terpusat untuk "membersihkan" sisa-sisa style
             * dari modal Bootstrap untuk mencegah bug layout.
             */
            function cleanupModalState() {
                $('.modal-backdrop').remove();
                $('body').removeClass('modal-open').css('padding-right', '');
                console.log('Modal state cleaned up.');
                
                // Reinitialize DataTables after modal cleanup
                setTimeout(() => {
                    initializeDataTables();
                }, 300);
            }

            // Menerapkan cleanup pada SEMUA modal saat selesai ditutup.
            // Ini lebih efisien daripada mendaftarkan setiap modal satu per satu.
            $(document).on('hidden.bs.modal', '.modal', function() {
                cleanupModalState();
            });

            // --- SEMUA EVENT LISTENER UNTUK MENAMPILKAN MODAL ---

            // Dari Livewire (dipakai komponen modal terpisah)
            Livewire.on('open-data-pendukung-modal', () => $('#data-pendukung').modal('show'));
            Livewire.on('open-staf-data-pendukung-modal', () => $('#staf-data-pendukung').modal('show'));

            // Dari window (dipakai komponen tabel)
            window.addEventListener('showEditModal', () => $('#editModal').modal('show'));
            window.addEventListener('showDeleteModal', () => $('#deleteConfirmModal').modal('show'));
            window.addEventListener('showRincianTugasModal', () => $('#rincianTugasModal').modal('show'));
            window.addEventListener('showEditModal2', () => $('#editModal2').modal('show'));
            window.addEventListener('showDeleteModal2', () => $('#deleteConfirmModal2').modal('show'));
            window.addEventListener('showRincianTugasModal2', () => $('#rincianTugasModal2').modal('show'));

            // --- SEMUA EVENT LISTENER UNTUK MENUTUP MODAL ---

            // Dari Livewire
            Livewire.on('hideEditModal', () => $('#editModal').modal('hide'));
            Livewire.on('hideDeleteModal', () => $('#deleteConfirmModal').modal('hide'));
            Livewire.on('hideEditModal2', () => $('#editModal2').modal('hide'));
            Livewire.on('hideDeleteModal2', () => $('#deleteConfirmModal2').modal('hide'));
            Livewire.on('close-data-pendukung-modal', () => $('#data-pendukung').modal('hide'));
            Livewire.on('close-staf-data-pendukung-modal', () => {
                $('#staf-data-pendukung').modal('hide');
                // Beri jeda agar transisi selesai sebelum cleanup
                setTimeout(cleanupModalState, 150);
            });

            // --- FUNGSI FEEDBACK & DEBUGGING ---

            // Notifikasi sukses (jika Anda menggunakan modal sukses)
            Livewire.on('show-success-modal', (data) => {
                const successModal = $('#successModal');
                if (successModal.length) {
                    $('#successModalTitle').text(data.title || 'Berhasil!');
                    $('#successModalMessage').text(data.message || 'Tindakan berhasil dilaksanakan.');
                    successModal.modal('show');

                    setTimeout(() => {
                        successModal.modal('hide');
                    }, 2500);
                } else {
                    console.warn('Success modal with ID #successModal not found.');
                }
            });

            // Notifikasi visual saat data dipindahkan antar tabel
            Livewire.on('dataMovedToTable1', (uraianTugasId) => {
                console.log('Data moved to Table1, ID:', uraianTugasId);
                const newRow = document.querySelector(`tr[data-id="${uraianTugasId}"]`);
                if (newRow) {
                    newRow.style.transition = 'background-color 0.5s ease';
                    newRow.style.backgroundColor = '#d4edda'; // Warna hijau lembut
                    setTimeout(() => {
                        newRow.style.backgroundColor = ''; // Kembali ke warna normal
                    }, 3000);
                }
            });

            // Log untuk memantau status upload
            Livewire.on('checkStatusAfterUpload', (uraianTugasId) => {
                console.log('Checking status after upload for ID:', uraianTugasId);
            });

            console.log('All modal event listeners have been successfully registered.');
        });

        // --- Skrip jQuery non-Livewire (seperti pilihan file, dll) ---
        // Diletakkan di luar 'livewire:initialized' agar selalu berjalan.
        $(document).ready(function() {
            $('#inputType').on('change', function() {
                const selected = $(this).val();
                $('#link-group').toggle(selected === 'link');
                $('#file-group').toggle(selected === 'file');
            });

            // Update label nama file saat file dipilih
            $(document).on('change', '#exampleInputFile', function() {
                const fileName = $(this).val().split('\\').pop();
                $(this).next('.custom-file-label').addClass("selected").html(fileName ||
                    'Choose file');
            });

            // Reset modal input saat ditutup
            $('#modal-default').on('hidden.bs.modal', function() {
                $('#inputType').val('').trigger('change');
                $('#link-input').val('');
                $('#exampleInputFile').val('');
                $('.custom-file-label').text('Choose file');
                $('#link-group').hide();
                $('#file-group').hide();
            });
        });
    </script>
@endpush
