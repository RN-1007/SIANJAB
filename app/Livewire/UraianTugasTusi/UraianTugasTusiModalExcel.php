<?php

namespace App\Livewire\UraianTugasTusi;

use App\Imports\UraianTugasTusiImport;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class UraianTugasTusiModalExcel extends Component
{
    use WithFileUploads;

    public $fileExcel;

    public function render()
    {
        return view('livewire.uraian-tugas-tusi.uraian-tugas-tusi-modal-excel');
    }

    public function importExcel()
    {
        $this->validate([
            'fileExcel' => 'required|mimes:xls,xlsx|max:2048',
        ]);

        $import = new UraianTugasTusiImport;

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
                    'message' => 'Semua data relasi Uraian Tugas & Tusi telah berhasil diimpor.'
                ]);
                $this->dispatch('uraian-tugas-tusi-created');
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