<?php

namespace App\Livewire\StrukturJabatan;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Imports\StrukturJabatanImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;
use App\Models\DataPd;

class StrukturJabatanModalExcel extends Component
{
    use WithFileUploads;

    public $fileExcel;
    public $idPd;

    protected $listeners = ['pdImportSelected'];

    public function pdImportSelected($pdId)
    {
        $this->idPd = $pdId;
    }

    public function render()
    {
        $perangkatDaerahs = DataPd::orderBy('nama_pd')->get();

        return view('livewire.struktur-jabatan.struktur-jabatan-modal-excel', [
            'perangkatDaerahs' => $perangkatDaerahs
        ]);
    }

    public function importExcel()
    {
        $this->validate([
            'idPd'      => 'required|integer|exists:data_pds,id',
            'fileExcel' => 'required|mimes:xls,xlsx|max:2048',
        ], [
            'idPd.required' => 'Anda harus memilih Perangkat Daerah (PD) terlebih dahulu.',
            'idPd.exists'   => 'Perangkat Daerah (PD) yang dipilih tidak valid.'
        ]);

        $import = new StrukturJabatanImport($this->idPd);

        $shouldRedirect = false;
        $successMessage = '';

        try {
            Excel::import($import, $this->fileExcel);

            $failures = $import->getFailures();
            $importedRowCount = $import->getImportedRowCount();

            if ($failures->isNotEmpty()) {
                $errorRows = [];
                foreach ($failures as $failure) {
                    $errorRows[] = '<b>Sheet "' . $failure['sheet'] . '" - Baris ' . $failure['row'] . '</b>: ' . implode(', ', $failure['errors']);
                }
                $errorMessage = 'Ditemukan ' . count($errorRows) . ' baris error:<br><br><ul style="text-align: left; margin-left: 20px;"><li>' . implode('</li><li>', $errorRows) . '</li></ul>';

                Log::error('IMPORT VALIDATION FAILED: ' . strip_tags($errorMessage));

                $this->dispatch('import-error', [
                    'title' => 'Beberapa Data Gagal Diimpor!',
                    'message' => $errorMessage
                ]);
            } elseif ($importedRowCount === 0) {
                $errorMessage = 'Tidak ada data yang berhasil diimpor. Pastikan file Excel Anda tidak kosong dan nama kolomnya sudah sesuai dengan format yang disediakan (contoh: "nama_jabatan", "kelas_jabatan", "nama_jabatan_parent").';

                Log::warning('IMPORT FAILED (WRONG FORMAT): ' . $errorMessage);

                $this->dispatch('import-error', [
                    'title' => 'Format File Tidak Sesuai!',
                    'message' => $errorMessage
                ]);
            } else {
                $this->dispatch('import-success', [
                    'title' => 'Import Berhasil!',
                    'message' => $importedRowCount . ' baris data Struktur Jabatan telah berhasil diimpor.'
                ]);
                $successMessage = $importedRowCount . ' baris data Struktur Jabatan telah berhasil diimpor.';
                $shouldRedirect = true;
            }
        } catch (\Exception $e) {
            Log::error('IMPORT STRUKTUR JABATAN GAGAL: ' . $e->getMessage() . ' On line ' . $e->getLine() . ' in ' . $e->getFile());
            $this->dispatch('import-error', [
                'title' => 'Terjadi Kesalahan Sistem!',
                'message' => 'Tidak dapat memproses file. Pastikan format file benar atau hubungi administrator. (' . $e->getMessage() . ')'
            ]);
        } finally {
            if (!$shouldRedirect) {
                $this->dispatch('close-import-struktur-jabatan-modal');
            }else {
                $this->reset(['fileExcel', 'idPd']);
            }
        }

        if ($shouldRedirect) {
            session()->flash('message', $successMessage);
            return redirect(request()->header('Referer'));
        }
    }
}
