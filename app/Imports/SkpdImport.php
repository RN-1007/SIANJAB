<?php

namespace App\Imports;

use App\Models\DataPd;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;

HeadingRowFormatter::default('none');

class SkpdImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use SkipsFailures;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // Ini sudah benar, 'Nama SKPD' dari Excel akan diisi ke 'nama_pd' di model
        return new DataPd([
            'nama_pd' => $row['Nama PD'],
        ]);
    }

    public function rules(): array
    {
        return [
            // PERBAIKAN: Sesuaikan nama tabel di aturan 'unique'
            // agar sama dengan yang ada di Model DataPd (yaitu 'data_pds')
            'Nama PD' => ['required', 'string', 'unique:data_pds,nama_pd'],
        ];
    }

    public function customValidationMessages()
    {
        return [
            'Nama PD.required' => 'Kolom Nama PD tidak boleh kosong.',
            'Nama PD.unique' => 'Nama PD ini sudah ada di database.',
        ];
    }
}