<?php

namespace App\Imports;

use App\Models\StrukturJabatan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Validation\Rule;

class StrukturJabatanPerSheetImport implements ToModel, WithValidation, SkipsOnFailure, WithHeadingRow
{
    use Importable, SkipsFailures;

    private $tipeJabatan;
    private $idPd;

    // --- TAMBAHAN BARU ---
    // Properti publik untuk melacak jumlah baris yang diproses
    public $rowCount = 0;
    // --- BATAS TAMBAHAN ---

    public function __construct(string $tipeJabatan, int $idPd)
    {
        $this->tipeJabatan = $tipeJabatan;
        $this->idPd = $idPd;
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // --- TAMBAHAN BARU ---
        // Tambahkan 1 ke penghitung setiap kali fungsi model dipanggil
        $this->rowCount++;
        // --- BATAS TAMBAHAN ---

        $parentId = null;
        
        $parentNamaJabatan = $row['nama_jabatan_parent'] ?? null;

        if (!empty($parentNamaJabatan)) {
            $parent = StrukturJabatan::where('nama_jabatan', $parentNamaJabatan)
                ->where('id_pd', $this->idPd)
                ->first();

            if ($parent) {
                $parentId = $parent->id;
            }
        }

        $attributes = [
            'id_pd'        => $this->idPd,
            'nama_jabatan' => $row['nama_jabatan'], 
        ];

        $values = [
            'parent_id'     => $parentId,
            'tipe_jabatan'  => $this->tipeJabatan,
            'kelas_jabatan' => $row['kelas_jabatan'],
        ];

        return StrukturJabatan::updateOrCreate($attributes, $values);
    }

    // (Fungsi rules() dan customValidationMessages() Anda tidak perlu diubah)
    public function rules(): array
    {
        return [
            'nama_jabatan'  => 'required|string|max:255',
            'kelas_jabatan' => 'required|integer|min:1|max:20',

            'nama_jabatan_parent' => [
                'nullable', 
                'string',
                Rule::exists('struktur_jabatans', 'nama_jabatan')->where(function ($query) {
                    return $query->where('id_pd', $this->idPd);
                }),
            ],
        ];
    }

    public function customValidationMessages()
    {
        return [
            'nama_jabatan_parent.exists' => 'Nama Jabatan Parent yang dimasukkan tidak dapat ditemukan di dalam PD ini. Pastikan parent diimpor terlebih dahulu (ada di sheet sebelumnya atau baris di atasnya).',
            'nama_jabatan.required' => 'Kolom Nama Jabatan (nama_jabatan) wajib diisi.',
            'kelas_jabatan.required' => 'Kolom Kelas Jabatan (kelas_jabatan) wajib diisi.',
        ];
    }
}

