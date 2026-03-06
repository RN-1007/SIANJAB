<?php

namespace App\Livewire\StafUtama;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Imports\StafUtamaImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;

class StafUtamaModalExcel extends Component
{
    use WithFileUploads;

    public $fileExcel;

    public function render()
    {
        return view('livewire.staf-utama.staf-utama-modal-excel');
    }

    public function importExcel()
    {
        $this->validate([
            'fileExcel' => 'required|mimes:xls,xlsx|max:2048',
        ]);

        $import = new StafUtamaImport;

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
                    'message' => 'Semua data Staf Utama telah berhasil diimpor.'
                ]);
                $this->dispatch('refresh-staf-utama-table');
            }

        } catch (\Exception $e) {
            Log::error('IMPORT STAF UTAMA GAGAL: ' . $e->getMessage());
            $this->dispatch('import-error', [
                'title' => 'Terjadi Kesalahan Sistem!',
                'message' => 'Tidak dapat memproses file. Silakan hubungi administrator.'
            ]);
        } finally {
            $this->reset('fileExcel');
            $this->dispatch('close-import-staf-modal');
        }
    }
}