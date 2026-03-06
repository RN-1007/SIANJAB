<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DataUraianTugasStaf; // Pastikan model ini ada

class DataUraianTugasStafSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Staf Ahli
        DataUraianTugasStaf::create([
            'id_user'             => 2,
            'kelas_jabatan'       => '7',
            'pns'                 => 1,
            'non_pns' => 0,
            'pppk' => 0,
            'cpns' => 0,
            'jumlah_eksisting'    => 1,
            'pemenuhan_pegawai'   => 3,
        ]);

        DataUraianTugasStaf::create([
            'id_user'             => 3,
            'kelas_jabatan'       => '7',
            'pns'                 => 1,
            'non_pns' => 0,
            'pppk' => 0,
            'cpns' => 0,
            'jumlah_eksisting'    => 1,
            'pemenuhan_pegawai'   => 3,
        ]);

        DataUraianTugasStaf::create([
            'id_user'             => 4,
            'kelas_jabatan'       => '7',
            'pns'                 => 1,
            'non_pns' => 0,
            'pppk' => 0,
            'cpns' => 0,
            'jumlah_eksisting'    => 1,
            'pemenuhan_pegawai'   => 3,
        ]);

        // Jabatan Fungsional Tententu
        DataUraianTugasStaf::create(['id_user' => 5, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 6, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 7, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 8, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 9, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 10, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 11, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 12, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);

        // Kepala Bagian Perekonomian dan Sumber Daya Alam
        DataUraianTugasStaf::create(['id_user' => 14, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 15, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 16, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 17, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 18, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 19, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);

        // Kepala Bagian Administrasi Pembangunan
        DataUraianTugasStaf::create(['id_user' => 21, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 22, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 23, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 24, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 25, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 26, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 27, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);

        // Kepala Bagian Pengadaan Barang Dan Jasa
        DataUraianTugasStaf::create(['id_user' => 29, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 30, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 31, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 32, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 33, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 34, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 35, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 36, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 37, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 38, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);

        // Kepala Bagian Tata Pemerintahan
        DataUraianTugasStaf::create(['id_user' => 40, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 41, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 42, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 43, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 44, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 45, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 46, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 47, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);

        // Kepala Bagian Hukum
        DataUraianTugasStaf::create(['id_user' => 49, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 50, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 51, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 52, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 53, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 54, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 55, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 56, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 57, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 58, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 59, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);

        // Kepala Bagian Kesejahteraan Rakyat
        DataUraianTugasStaf::create(['id_user' => 61, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 62, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 63, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 64, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 65, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 66, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 67, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);

        // Kepala Bagian Umum
        DataUraianTugasStaf::create(['id_user' => 69, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 70, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 71, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 72, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 73, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 74, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 75, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 76, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 77, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 78, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 79, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 80, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 81, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 82, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 83, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 84, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 85, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 86, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);

        // Kepala Bagian Organisasi
        DataUraianTugasStaf::create(['id_user' => 88, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 89, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 90, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 91, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 92, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 93, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 94, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 95, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 96, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);

        // Kepala Bagian Protokol dan Komunikasi Pimpinan
        DataUraianTugasStaf::create(['id_user' => 98, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 99, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 100, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 101, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 102, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 103, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 104, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 105, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 106, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 107, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 108, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 109, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 110, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 111, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);

        // Kepala Sub Bagian Protokol
        DataUraianTugasStaf::create(['id_user' => 113, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 114, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 115, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
        DataUraianTugasStaf::create(['id_user' => 116, 'kelas_jabatan' => '7', 'pns' => 1, 'non_pns' => 0, 'pppk' => 0, 'cpns' => 0, 'jumlah_eksisting' => 1, 'pemenuhan_pegawai' => 3]);
    }
}
