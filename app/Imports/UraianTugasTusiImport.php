<?php

namespace App\Imports;

use App\Models\DataUraianTugasStaf;
use App\Models\TugasDanFungsi;
use App\Models\UraianTugasDanTusi;
use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

// 1. TAMBAHKAN USE STATEMENT INI
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\SkipsFailures;

HeadingRowFormatter::default('none');

class UraianTugasTusiImport implements ToCollection, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use SkipsFailures;

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $tusi = TugasDanFungsi::where('code_tusi', trim($row['Code Tusi']))->first();
            $user = User::where('nama_jabatan', 'LIKE', trim($row['Nama Jabatan']))->first();

            if ($user) {
                $uraianTugasStaf = DataUraianTugasStaf::where('id_user', $user->id)->first();

                if ($tusi && $uraianTugasStaf) {
                    UraianTugasDanTusi::firstOrCreate([
                        'id_uraian_tugas_staf' => $uraianTugasStaf->id,
                        'id_tusi' => $tusi->id,
                    ]);
                }
            }
        }
    }

    public function rules(): array
    {
        return [
            'Code Tusi' => ['required', 'integer', 'exists:tugas_dan_fungsis,code_tusi'],
            'Nama Jabatan' => ['required', 'string', 'exists:users,nama_jabatan'],
        ];
    }

    public function customValidationMessages()
    {
        return [
            'Code Tusi.required' => 'Kolom Code Tusi tidak boleh kosong.',
            'Code Tusi.exists' => 'Code Tusi yang dimasukkan tidak terdaftar.',
            'Nama Jabatan.required' => 'Kolom Nama Jabatan tidak boleh kosong.',
            'Nama Jabatan.exists' => 'Nama Jabatan yang dimasukkan tidak terdaftar.',
        ];
    }
}