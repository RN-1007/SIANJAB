<?php

namespace App\Livewire\UserMaster;

use App\Imports\UsersImport;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;

class UserMasterImportModal extends Component
{
    use WithFileUploads;

    public $fileExcel;

    public function render()
    {
        return view('livewire.user-master.user-master-import-modal');
    }
    public function importExcel()
    {
        $this->validate([
            'fileExcel' => 'required|mimes:xls,xlsx|max:2048',
        ]);

        $import = new UsersImport;

        try {
            Excel::import($import, $this->fileExcel);

            if ($import->failures()->isNotEmpty()) {
                $errorRows = [];
                foreach ($import->failures() as $failure) {
                    $errorRows[] = '<b>Baris ' . $failure->row() . '</b>: ' . implode(', ', $failure->errors());
                }

                $errorMessage = 'Ditemukan ' . count($errorRows) . ' baris error:<br><br><ul style="text-align: left; margin-left: 20px;"><li>' . implode('</li><li>', $errorRows) . '</li></ul>';
                
                Log::warning('Import user GAGAL validasi. Total error: ' . count($errorRows), $import->failures()->toArray());

                $this->dispatch('import-error', [
                    'title' => 'Beberapa Data Gagal Diimpor!',
                    'message' => $errorMessage
                ]);
            } else {
                Log::info('Import user BERHASIL (lolos validasi).');

                $this->dispatch('import-success', [
                    'title' => 'Import Berhasil!',
                    'message' => 'Semua data user telah berhasil diimpor.'
                ]);
                $this->dispatch('refresh-user-table');
            }
        } catch (\Exception $e) {
            
            Log::error('Import user GAGAL TOTAL (Exception). Error: ' . $e->getMessage(), [
                'file' => $this->fileExcel->getClientOriginalName(),
                'trace' => $e->getTraceAsString()
            ]);

            $this->dispatch('import-error', [
                'title' => 'Terjadi Kesalahan Sistem!',
                'message' => 'Tidak dapat memproses file. Silakan hubungi administrator. Detail: ' . $e->getMessage(),
            ]);
        } finally {
            $this->reset('fileExcel');
            $this->dispatch('close-import-user-modal');
            $this->dispatch('refresh-user-table');
        }
    }
}