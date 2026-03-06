<?php

namespace App\Livewire\Tusi;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Imports\TusiImport;
use Maatwebsite\Excel\Facades\Excel;

class TusiModalExcel extends Component
{
    use WithFileUploads;

    public $fileExcel;

    public function render()
    {
        return view('livewire.tusi.tusi-modal-excel');
    }

    public function importExcel()
    {
        $this->validate([
            'fileExcel' => 'required|mimes:xls,xlsx',
        ]);

        $import = new TusiImport;

        try {
            Excel::import($import, $this->fileExcel);

            if ($import->failures()->isNotEmpty()) {
                $errorRows = [];
                foreach ($import->failures() as $failure) {
                    $errorRows[] = '<b>Baris ' . $failure->row() . '</b>: ' . implode(', ', $failure->errors());
                }
                $errorMessage = 'Ditemukan ' . count($errorRows) . ' baris error:<br><br><ul style="text-align: left; margin-left: 20px;"><li>' . implode('</li><li>', $errorRows) . '</li></ul>';

                $this->dispatch('import-error', [
                    'title' => 'Beberapa Data Gagal Diimpor!',
                    'message' => $errorMessage
                ]);

            } else {
                $this->dispatch('import-success', [
                    'title' => 'Import Berhasil!',
                    'message' => 'Semua data Tusi telah berhasil diimpor.'
                ]);
                $this->dispatch('refresh-tusi-in-table');
            }

        } catch (\Exception $e) {
            $this->dispatch('import-error', [
                'title' => 'Terjadi Kesalahan Sistem!',
                'message' => 'Tidak dapat memproses file. Silakan hubungi administrator. Detail: ' . $e->getMessage(),
            ]);
        } finally {
            $this->reset('fileExcel');
            $this->dispatch('close-import-tusi-modal');
        }
    }
}