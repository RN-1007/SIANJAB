<?php

namespace App\Imports;

use App\Models\TugasDanFungsi;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;

HeadingRowFormatter::default('none');

class TusiImport implements ToCollection, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use SkipsFailures;

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            TugasDanFungsi::create([
                'code_tusi' => trim($row['Code Tusi']),
                'tusi' => trim($row['Tusi'] ?? ''),
                'nama_jabatan_permempan_45' => trim($row['Nama Jabatan Permempan 45'] ?? ''),
                'nama_jabatan_permempan_41' => trim($row['Nama Jabatan Permempan 41'] ?? '')
            ]);
        }
    }

    public function rules(): array
    {
        return [
            'Code Tusi' => [
                'required',
                'integer',
                'distinct', 
                'unique:tugas_dan_fungsis,code_tusi' 
            ],

            'Tusi' => ['required', 'string'],
        ];
    }

    public function customValidationMessages()
    {
        return [
            'Code Tusi.required' => 'Kolom Code Tusi tidak boleh kosong.',
            'Code Tusi.integer' => 'Kolom Code Tusi harus berupa angka.',
            'Code Tusi.distinct' => 'Terdapat Code Tusi yang duplikat di dalam file Excel.',
            'Code Tusi.unique' => 'Code Tusi ini sudah terdaftar di database.', 
            'Tusi.required' => 'Kolom Tusi tidak boleh kosong.',
        ];
    }

    // ...
}
