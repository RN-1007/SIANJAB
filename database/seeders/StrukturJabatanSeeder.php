<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StrukturJabatan;

class StrukturJabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Jabatan Pimpinan Tinggi (Level Puncak)
        $jpt = StrukturJabatan::create([
            'id_pd' => 1,
            'parent_id' => null,
            'nama_jabatan' => 'Sekretaris Daerah',
            'tipe_jabatan' => 'Pimpinan Tinggi',
            'kelas_jabatan' => 15,
        ]);
        StrukturJabatan::create([
            'id_pd' => 1,
            'parent_id' => $jpt->id,
            'nama_jabatan' => 'Staf Ahli',
            'tipe_jabatan' => 'Staf Ahli',
            'kelas_jabatan' => 13,
        ]);
        StrukturJabatan::create([
            'id_pd' => 1,
            'parent_id' => $jpt->id,
            'nama_jabatan' => 'Jabatan Fungsional Tertentu',
            'tipe_jabatan' => 'Jabatan Fungsional',
            'kelas_jabatan' => 12,
        ]);

        // 3. Nomenklatur Jabatan 1
        $nomenklatur1 = StrukturJabatan::create([
            'id_pd' => 1,
            'parent_id' => $jpt->id,
            'nama_jabatan' => 'Asisten Perekonomian dan Pembangunan',
            'tipe_jabatan' => 'Nomenklatur Jabatan',
            'kelas_jabatan' => 14,
        ]);

        // 4. Kepala Bagian Bagian Kanan
        StrukturJabatan::create([
            'id_pd' => 1,
            'parent_id' => $nomenklatur1->id,
            'nama_jabatan' => 'Kepala Bagian Perekonomian dan Sumber Daya Alam',
            'tipe_jabatan' => 'Kepala',
            'kelas_jabatan' => 12,
        ]);
        StrukturJabatan::create([
            'id_pd' => 1,
            'parent_id' => $nomenklatur1->id,
            'nama_jabatan' => 'Kepala Bagian Administrasi Pembangunan',
            'tipe_jabatan' => 'Kepala',
            'kelas_jabatan' => 12,
        ]);
        StrukturJabatan::create([
            'id_pd' => 1,
            'parent_id' => $nomenklatur1->id,
            'nama_jabatan' => 'Kepala Bagian Pengadaan Barang Dan Jasa',
            'tipe_jabatan' => 'Kepala',
            'kelas_jabatan' => 12,
        ]);

        // 5. Nomenklatur Jabatan 2
        $nomenklatur2 = StrukturJabatan::create([
            'id_pd' => 1,
            'parent_id' => $jpt->id,
            'nama_jabatan' => 'Asisten Pemerintahan dan Kesejahteraan Rakyat',
            'tipe_jabatan' => 'Nomenklatur Jabatan',
            'kelas_jabatan' => 14,
        ]);

        // 6. Kepala Bagian Bagian Kiri
        StrukturJabatan::create([
            'id_pd' => 1,
            'parent_id' => $nomenklatur2->id,
            'nama_jabatan' => 'Kepala Bagian Tata Pemerintahan',
            'tipe_jabatan' => 'Kepala',
            'kelas_jabatan' => 12,
        ]);
        StrukturJabatan::create([
            'id_pd' => 1,
            'parent_id' => $nomenklatur2->id,
            'nama_jabatan' => 'Kepala Bagian Hukum',
            'tipe_jabatan' => 'Kepala',
            'kelas_jabatan' => 12,
        ]);
        StrukturJabatan::create([
            'id_pd' => 1,
            'parent_id' => $nomenklatur2->id,
            'nama_jabatan' => 'Kepala Bagian Kesejahteraan Rakyat',
            'tipe_jabatan' => 'Kepala',
            'kelas_jabatan' => 12,
        ]);

        // 7. Nomenklatur Jabatan 3
        $nomenklatur3 = StrukturJabatan::create([
            'id_pd' => 1,
            'parent_id' => $jpt->id,
            'nama_jabatan' => 'Asisten Administrasi dan Umum',
            'tipe_jabatan' => 'Nomenklatur Jabatan',
            'kelas_jabatan' => 14,
        ]);

        // 6. Kepala Bagian Bagian Tengah
        StrukturJabatan::create([
            'id_pd' => 1,
            'parent_id' => $nomenklatur3->id,
            'nama_jabatan' => 'Kepala Bagian Umum',
            'tipe_jabatan' => 'Kepala',
            'kelas_jabatan' => 12,
        ]);
        StrukturJabatan::create([
            'id_pd' => 1,
            'parent_id' => $nomenklatur3->id,
            'nama_jabatan' => 'Kepala Bagian Organisasi',
            'tipe_jabatan' => 'Kepala',
            'kelas_jabatan' => 12,
        ]);
        $kabag = StrukturJabatan::create([
            'id_pd' => 1,
            'parent_id' => $nomenklatur3->id,
            'nama_jabatan' => 'Kepala Bagian Protokol dan Komunikasi Pimpinan',
            'tipe_jabatan' => 'Kepala',
            'kelas_jabatan' => 12,
        ]);
        StrukturJabatan::create([
            'id_pd' => 1,
            'parent_id' => $kabag->id,
            'nama_jabatan' => 'Kepala Sub Bagian Protokol',
            'tipe_jabatan' => 'Sub Kepala',
            'kelas_jabatan' => 9,
        ]);
    }
}
