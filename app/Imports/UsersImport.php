<?php

namespace App\Imports;

use App\Models\User;
use App\Models\DataUraianTugasStaf;
use App\Models\StrukturJabatan;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;

HeadingRowFormatter::default('none');

class UsersImport implements ToCollection, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use SkipsFailures;

    public function collection(Collection $rows)
    {
        foreach ($rows as $index => $row) {

            $excelRowNum = $index + 2;

            $jabatan = StrukturJabatan::where('nama_jabatan', trim($row['Jabatan Struktural']))->first();

            if ($jabatan) {
                try {
                    DB::transaction(function () use ($row, $jabatan, $excelRowNum) {

                        $user = User::create([
                            'id_jabatan'        => $jabatan->id,
                            'username'          => $row['Username'],
                            'role'              => strtolower($row['Role']),
                            'jabatan_staf'      => strtolower($row['Jabatan Staf']),
                            'status'            => strtolower($row['Status']),
                            'jabatan'           => $row['Nama Jabatan'],
                            'password'          => Hash::make($row['Password']),
                        ]);

                        Log::info("Baris {$excelRowNum}: Sukses membuat user '{$user->username}'.");

                        $role = strtolower($row['Role']);

                        if (in_array($role, ['user', 'mahasiswa'])) {
                            DataUraianTugasStaf::create([
                                'id_user'           => $user->id,
                                'kelas_jabatan'     => $row['Kelas Jabatan'] ?? 0,
                                'jumlah_eksisting'  => $row['Jumlah Eksisting'] ?? 0,
                                'pns'               => $row['PNS'] ?? 0,
                                'non_pns'           => $row['Non PNS'] ?? 0,
                                'pppk'              => $row['PPPK'] ?? 0,
                                'cpns'              => $row['CPNS'] ?? 0,
                                'pemenuhan_pegawai' => $row['Pemenuhan Pegawai'] ?? 0,
                            ]);
                            Log::info("Baris {$excelRowNum}: Sukses membuat DataUraianTugasStaf untuk user '{$user->username}'.");
                        }
                    });
                } catch (\Exception $e) {
                    Log::error("Baris {$excelRowNum}: Gagal saat transaksi DB untuk user '{$row['Username']}'. Error: " . $e->getMessage(), $row->toArray());
                }
            } else {
                Log::warning("Baris {$excelRowNum}: GAGAL. Jabatan Struktural '{$row['Jabatan Struktural']}' tidak ditemukan. Baris dilewati.", $row->toArray());
            }
        }
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'Username' => ['required', 'string', 'unique:users,username'],
            'Role' => ['required', 'in:admin,user,kepala,subkepala,mahasiswa'],
            'Jabatan Staf' => ['nullable', 'in:fungsional,pelaksana'],
            'Status' => ['required', 'in:inactive,active'],
            'Password' => ['required', 'min:6'],

            'Jabatan Struktural' => ['required', 'exists:struktur_jabatans,nama_jabatan'],
            'Nama Jabatan' => ['nullable', 'string'],


            'Kelas Jabatan' => ['required_if:Role,user', 'required_if:Role,mahasiswa', 'nullable'],
            'PNS' => ['required_if:Role,user', 'required_if:Role,mahasiswa', 'nullable', 'integer', 'min:0'],
            'Non PNS' => ['required_if:Role,user', 'required_if:Role,mahasiswa', 'nullable', 'integer', 'min:0'],
            'PPPK' => ['required_if:Role,user', 'required_if:Role,mahasiswa', 'nullable', 'integer', 'min:0'],
            'CPNS' => ['required_if:Role,user', 'required_if:Role,mahasiswa', 'nullable', 'integer', 'min:0'],
            'Jumlah Eksisting' => ['required_if:Role,user', 'required_if:Role,mahasiswa', 'nullable', 'integer'],
            'Pemenuhan Pegawai' => ['required_if:Role,user', 'required_if:Role,mahasiswa', 'nullable', 'integer'],
        ];
    }
}
