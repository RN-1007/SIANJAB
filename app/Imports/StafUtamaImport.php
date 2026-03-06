<?php

namespace App\Imports;

use App\Models\DataPd;
use App\Models\DataStafUtama;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\SkipsFailures;

HeadingRowFormatter::default('none');

class StafUtamaImport implements ToCollection, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use SkipsFailures;

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $skpd = DataPd::where('nama_pd', 'LIKE', trim($row['Nama SKPD']))->first();

            if ($skpd) {
                DataStafUtama::create([
                    'id_skpd' => $skpd->id,
                    'nomenklatur_jabatan_struktural' => $row['Nomenklatur Jabatan Struktural'],
                ]);
            }
        }
    }

    public function rules(): array
    {
        return [
            'Nama SKPD' => ['required', 'exists:data_skpds,nama_pd'],

            'Nomenklatur Jabatan Struktural' => ['required', 'string'],
        ];
    }

    public function customValidationMessages()
    {
        return [
            'Nama SKPD.required' => 'Kolom Nama SKPD tidak boleh kosong.',
            'Nama SKPD.exists' => 'Nama SKPD yang dimasukkan tidak terdaftar di database.',
            'Nomenklatur Jabatan Struktural.required' => 'Kolom Nomenklatur Jabatan Struktural tidak boleh kosong.',
        ];
    }
}