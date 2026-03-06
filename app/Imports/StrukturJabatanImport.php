<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class StrukturJabatanImport implements WithMultipleSheets, SkipsUnknownSheets
{
    use Importable;

    private $idPd;
    private $sheets;

    public function __construct(int $idPd)
    {
        $this->idPd = $idPd;

        $this->sheets = [
            'Pimpinan Tinggi'     => new StrukturJabatanPerSheetImport('Pimpinan Tinggi', $this->idPd),
            'Staf Ahli'           => new StrukturJabatanPerSheetImport('Staf Ahli', $this->idPd),
            'Jabatan Fungsional'  => new StrukturJabatanPerSheetImport('Jabatan Fungsional', $this->idPd),
            'Nomenklatur Jabatan' => new StrukturJabatanPerSheetImport('Nomenklatur Jabatan', $this->idPd),
            'Kepala'              => new StrukturJabatanPerSheetImport('Kepala', $this->idPd),
            'Sub Kepala'          => new StrukturJabatanPerSheetImport('Sub Kepala', $this->idPd),
        ];
    }

    public function sheets(): array
    {
        return $this->sheets;
    }

    public function getFailures(): Collection
    {
        $allFailures = collect();
        foreach ($this->sheets as $sheetName => $sheetImport) {
            foreach ($sheetImport->failures() as $failure) {
                $allFailures->push([
                    'sheet'     => $sheetName,
                    'row'       => $failure->row(),
                    'attribute' => $failure->attribute(),
                    'errors'    => $failure->errors(),
                    'values'    => $failure->values(),
                ]);
            }
        }
        return $allFailures;
    }

    /**
     * Fungsi kustom untuk mengambil total baris yang diproses
     * dari semua sheet.
     */
    public function getImportedRowCount(): int
    {
        $totalRows = 0;
        foreach ($this->sheets as $sheetImport) {
            // Pastikan kita memanggil properti dari class yang benar
            if ($sheetImport instanceof StrukturJabatanPerSheetImport) {
                $totalRows += $sheetImport->rowCount;
            }
        }
        return $totalRows;
    }

    public function onUnknownSheet($sheetName)
    {
        Log::warning("Import dilewati: Sheet dengan nama '{$sheetName}' tidak dikenal.");
    }
}
