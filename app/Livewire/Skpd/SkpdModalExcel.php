<?php

namespace App\Livewire\Skpd;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Imports\SkpdImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log; 

class SkpdModalExcel extends Component
{
    use WithFileUploads;

    public $fileExcel;

    public function render()
    {
        return view('livewire.skpd.skpd-modal-excel');
    }

    public function importExcel()
    {
        $this->validate([
            'fileExcel' => 'required|mimes:xls,xlsx|max:2048',
        ]);

        $import = new SkpdImport;

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
                    'message' => 'Semua data SKPD telah berhasil diimpor.'
                ]);
                $this->dispatch('refresh-skpd-table');
            }

        } catch (\Exception $e) {
            Log::error('IMPORT SKPD GAGAL: ' . $e->getMessage());
            $this->dispatch('import-error', [
                'title' => 'Terjadi Kesalahan Sistem!',
                'message' => 'Tidak dapat memproses file. Silakan hubungi administrator.'
            ]);
        } finally {
            $this->reset('fileExcel');
            $this->dispatch('close-import-modal');
        }
    }

}