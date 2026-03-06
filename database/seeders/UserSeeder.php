<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Admin Utama
        User::create([
            'id_jabatan'    => null,
            'jabatan'          => 'Administrator Utama',
            'username'         => 'admin',
            'password'      => Hash::make('password_aman'),
            'role'          => 'admin',
            'status'        => 'active',
        ]);

        User::create([
            'id_jabatan'    => 1,
            'jabatan'       => 'Sekretaris Daerah',
            'username'      => 'sekre',
            'password'      => Hash::make('password_aman'),
            'role'          => 'kepala',
            'status'        => 'active',
        ]);

        User::create([
            'id_jabatan'    => 4,
            'jabatan'       => 'Asisten Perekonomian dan Pembangunan',
            'username'      => 'assisten1',
            'password'      => Hash::make('password_aman'),
            'role'          => 'kepala',
            'status'        => 'active',
        ]);

        User::create([
            'id_jabatan'    => 8,
            'jabatan'       => 'Asisten Pemerintahan dan Kesejahteraan Rakyat',
            'username'      => 'assisten2',
            'password'      => Hash::make('password_aman'),
            'role'          => 'kepala',
            'status'        => 'active',
        ]);

        User::create([
            'id_jabatan'    => 12,
            'jabatan'       => 'Asisten Administrasi dan Umum',
            'username'      => 'testing3',
            'password'      => Hash::make('password_aman'),
            'role'          => 'kepala',
            'status'        => 'active',
        ]);

        // 2. Bagian Staf Ahli
        User::create([
            'id_jabatan'    => 2,
            'jabatan'       => 'Staf Ahli Bidang Pemerintahan, Hukum dan Politik',
            'username'      => '1.0',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 2,
            'jabatan'       => 'Staf Ahli Bidang Ekonomi, Keuangan dan Pembangunan',
            'username'      => '1.1',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 2,
            'jabatan'       => 'Staf Ahli Bidang Kemasyarakatan dan Sumber Daya Manusia',
            'username'      => '1.2',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);

        // 3. Jabatan Fungsional Tertentu
        User::create([
            'id_jabatan'    => 3,
            'jabatan'       => 'JF Pengelola Pengadaan Barang/Jasa Ahli Madya',
            'username'      => '2.0',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 3,
            'jabatan'       => 'JF Analis Kebijakan Ahli Madya',
            'username'      => '2.1',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 3,
            'jabatan'       => 'JF Perencana Ahli Madya',
            'username'      => '2.2',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 3,
            'jabatan'       => 'JF Analis Sumber Daya Manusia Aparatur Ahli Madya',
            'username'      => '2.3',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 3,
            'jabatan'       => 'JF Perancang Peraturan Perundang-Undangan Ahli Madya',
            'username'      => '2.4',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 3,
            'jabatan'       => 'JF Penyuluh Hukum Ahli Madya',
            'username'      => '2.5',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 3,
            'jabatan'       => 'JF Analis Hukum Ahli Madya',
            'username'      => '2.6',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 3,
            'jabatan'       => 'JF Pranata Hubungan Masyarakat Ahli Madya',
            'username'      => '2.7',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);

        // 4. Kepala Bagian Perekonomian dan Sumber Daya Alam 
        User::create([
            'id_jabatan'    => 5,
            'jabatan'       => 'Kepala Bagian Perekonomian dan Sumber Daya Alam',
            'username'      => '1.1.1',
            'password'      => Hash::make('password_aman'),
            'role'          => 'kepala',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 5,
            'jabatan'       => 'Penelaah Teknis Kebijakan',
            'username'      => '1.1.2',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 5,
            'jabatan'       => 'Fasilitator Pemerintahan',
            'username'      => '1.1.3',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 5,
            'jabatan'       => 'Pamong Pemerintahan',
            'username'      => '1.1.4',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 5,
            'jabatan'       => 'Pengadministrasi Perkantoran',
            'username'      => '1.1.5',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 5,
            'jabatan'       => 'JF Analis Kebijakan Ahli Muda',
            'username'      => '1.1.6',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 5,
            'jabatan'       => 'JF Analis Kebijakan Ahli Pertama',
            'username'      => '1.1.7',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);

        // 5. Kepala Bagian Administrasi Pembangunan
        User::create([
            'id_jabatan'    => 6,
            'jabatan'       => 'Kepala Bagian Administrasi Pembangunan',
            'username'      => '1.2.1',
            'password'      => Hash::make('password_aman'),
            'role'          => 'kepala',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 6,
            'jabatan'       => 'Penelaah Teknis Kebijakan',
            'username'      => '1.2.2',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 6,
            'jabatan'       => 'Pamong Pemerintahan',
            'username'      => '1.2.3',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 6,
            'jabatan'       => 'Fasilitator Pemerintahan',
            'username'      => '1.2.4',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 6,
            'jabatan'       => 'Pengolah Data Dan Informasi',
            'username'      => '1.2.5',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 6,
            'jabatan'       => 'Pengadministrasi Perkantoran',
            'username'      => '1.2.6',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 6,
            'jabatan'       => 'JF Analis Kebijakan Ahli Muda',
            'username'      => '1.2.7',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 6,
            'jabatan'       => 'JF Analis Kebijakan Ahli Pertama',
            'username'      => '1.2.8',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);

        // 6. Kepala Bagian Administrasi Pembangunan
        User::create([
            'id_jabatan'    => 7,
            'jabatan'       => 'Kepala Bagian Administrasi Pembangunan',
            'username'      => '1.3.1',
            'password'      => Hash::make('password_aman'),
            'role'          => 'kepala',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 7,
            'jabatan'       => 'Penelaah Teknis Kebijakan',
            'username'      => '1.3.2',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 7,
            'jabatan'       => 'Fasilitator Pemerintahan',
            'username'      => '1.3.3',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 7,
            'jabatan'       => 'Pamong Pemerintahan',
            'username'      => '1.3.4',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 7,
            'jabatan'       => 'Penata Kelola Sistem dan Teknologi Informasi',
            'username'      => '1.3.5',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 7,
            'jabatan'       => 'Pengolah Data Dan Informasi',
            'username'      => '1.3.6',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 7,
            'jabatan'       => 'Pengadministrasi Perkantoran',
            'username'      => '1.3.7',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 7,
            'jabatan'       => 'JF Analis Kebijakan Ahli Muda',
            'username'      => '1.3.8',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 7,
            'jabatan'       => 'JF Pengelola Pengadaan Barang/Jasa Ahli Muda',
            'username'      => '1.3.9',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 7,
            'jabatan'       => 'JF Analis Kebijakan Ahli Pertama',
            'username'      => '1.3.10',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 7,
            'jabatan'       => 'JF Pengelola Pengadaan Barang/Jasa Ahli Pertama',
            'username'      => '1.3.11',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);

        // 7. Kepala Bagian Tata Pemerintahan
        User::create([
            'id_jabatan'    => 9,
            'jabatan'       => 'Kepala Bagian Tata Pemerintahan',
            'username'      => '1.4.1',
            'password'      => Hash::make('password_aman'),
            'role'          => 'kepala',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 9,
            'jabatan'       => 'Penelaah Teknis Kebijakan',
            'username'      => '1.4.2',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 9,
            'jabatan'       => 'Penata Kelola Pemerintahan',
            'username'      => '1.4.3',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 9,
            'jabatan'       => 'Pranata Kewilayahan',
            'username'      => '1.4.4',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 9,
            'jabatan'       => 'Pamong Pemerintahan',
            'username'      => '1.4.5',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 9,
            'jabatan'       => 'Fasilitator Pemerintahan',
            'username'      => '1.4.6',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 9,
            'jabatan'       => 'Pengolah Data Dan Informasi',
            'username'      => '1.4.7',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 9,
            'jabatan'       => 'JF Analis Kebijakan Ahli Muda',
            'username'      => '1.4.8',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 9,
            'jabatan'       => 'JF Analis Kebijakan Ahli Pertama',
            'username'      => '1.4.9',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);

        // 8. Kepala Bagian Hukum
        User::create([
            'id_jabatan'    => 10,
            'jabatan'       => 'Kepala Bagian Hukum',
            'username'      => '1.5.1',
            'password'      => Hash::make('password_aman'),
            'role'          => 'kepala',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 10,
            'jabatan'       => 'Penelaah Teknis Kebijakan',
            'username'      => '1.5.2',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 10,
            'jabatan'       => 'Pengolah Data Dan Informasi',
            'username'      => '1.5.3',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 10,
            'jabatan'       => 'Pengadministrasi Perkantoran',
            'username'      => '1.5.4',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 10,
            'jabatan'       => 'JF Analis Kebijakan Ahli Muda',
            'username'      => '1.5.5',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 10,
            'jabatan'       => 'JF Perancang Peraturan Perundang-Undangan Ahli Muda',
            'username'      => '1.5.6',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 10,
            'jabatan'       => 'JF Analis Hukum Ahli Muda',
            'username'      => '1.5.7',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 10,
            'jabatan'       => 'JF Penyuluh Hukum Ahli Muda',
            'username'      => '1.5.8',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 10,
            'jabatan'       => 'JF Analis Kebijakan Ahli Pertama',
            'username'      => '1.5.9',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 10,
            'jabatan'       => 'JF Analis Hukum Ahli Pertama',
            'username'      => '1.5.10',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 10,
            'jabatan'       => 'JF Perancang Peraturan Perundang-Undangan Ahli Pertama',
            'username'      => '1.5.11',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 10,
            'jabatan'       => 'JF Penyuluh Hukum Ahli Pertama',
            'username'      => '1.5.12',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);

        // 8. Kepala Bagian Kesejahteraan Rakyat
        User::create([
            'id_jabatan'    => 11,
            'jabatan'       => 'Kepala Bagian Kesejahteraan Rakyat',
            'username'      => '1.6.1',
            'password'      => Hash::make('password_aman'),
            'role'          => 'kepala',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 11,
            'jabatan'       => 'Penelaah Teknis Kebijakan',
            'username'      => '1.6.2',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 11,
            'jabatan'       => 'Fasilitator Pemerintahan',
            'username'      => '1.6.3',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 11,
            'jabatan'       => 'Penata Kelola Sistem dan Teknologi Informasi',
            'username'      => '1.6.4',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 11,
            'jabatan'       => 'Pengadministrasi Perkantoran',
            'username'      => '1.6.5',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 11,
            'jabatan'       => 'JF Analis Kebijakan Ahli Muda',
            'username'      => '1.6.6',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 11,
            'jabatan'       => 'JF Analis Kebijakan Ahli Pertama',
            'username'      => '1.6.7',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 11,
            'jabatan'       => 'JF Pranata Komputer Terampil',
            'username'      => '1.6.8',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);

        // 9. Kepala Bagian Umum
        User::create([
            'id_jabatan'    => 13,
            'jabatan'       => 'Kepala Bagian Umum',
            'username'      => '1.7.1',
            'password'      => Hash::make('password_aman'),
            'role'          => 'kepala',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 13,
            'jabatan'       => 'Penelaah Teknis Kebijakan',
            'username'      => '1.7.2',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 13,
            'jabatan'       => 'Fasilitator Pemerintahan',
            'username'      => '1.7.3',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 13,
            'jabatan'       => 'Pengolah Data Dan Informasi',
            'username'      => '1.7.4',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 13,
            'jabatan'       => 'Pengelola Layanan Operasional',
            'username'      => '1.7.5',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 13,
            'jabatan'       => 'Pengadministrasi Perkantoran',
            'username'      => '1.7.6',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 13,
            'jabatan'       => 'Operator Layanan Operasional',
            'username'      => '1.7.7',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 13,
            'jabatan'       => 'Operator Layanan Operasional',
            'username'      => '1.7.8',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 13,
            'jabatan'       => 'Pengelola Umum Operasional',
            'username'      => '1.7.9',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 13,
            'jabatan'       => 'JF Analis Kebijakan Ahli Muda',
            'username'      => '1.7.10',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 13,
            'jabatan'       => 'JF Analis Kebijakan Ahli Pertama',
            'username'      => '1.7.11',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 13,
            'jabatan'       => 'JF Analis Sumber Daya Manusia Aparatur Ahli Pertama',
            'username'      => '1.7.12',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 13,
            'jabatan'       => 'JF Arsiparis Ahli Pertama',
            'username'      => '1.7.13',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 13,
            'jabatan'       => 'JF Arsiparis Penyelia',
            'username'      => '1.7.14',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 13,
            'jabatan'       => 'JF Arsiparis Mahir',
            'username'      => '1.7.15',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 13,
            'jabatan'       => 'JF Arsiparis Terampil',
            'username'      => '1.7.16',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 13,
            'jabatan'       => 'JF Pranata Komputer Penyelia',
            'username'      => '1.7.17',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 13,
            'jabatan'       => 'JF Pranata Komputer Mahir',
            'username'      => '1.7.18',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 13,
            'jabatan'       => 'JF Pranata Komputer Terampil',
            'username'      => '1.7.19',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);

        // 10. Kepala Bagian Organisasi
        User::create([
            'id_jabatan'    => 14,
            'jabatan'       => 'Kepala Bagian Organisasi',
            'username'      => '1.8.1',
            'password'      => Hash::make('password_aman'),
            'role'          => 'kepala',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 14,
            'jabatan'       => 'Penelaah Teknis Kebijakan',
            'username'      => '1.8.2',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 14,
            'jabatan'       => 'Pamong Pemerintahan',
            'username'      => '1.8.3',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 14,
            'jabatan'       => 'Pengolah Data Dan Informasi',
            'username'      => '1.8.4',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 14,
            'jabatan'       => 'Pengadministrasi Perkantoran',
            'username'      => '1.8.5',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 14,
            'jabatan'       => 'JF Analis Kebijakan Ahli Muda',
            'username'      => '1.8.6',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 14,
            'jabatan'       => 'JF Analis Sumber Daya Manusia Aparatur Ahli Muda',
            'username'      => '1.8.7',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 14,
            'jabatan'       => 'JF Analis Kebijakan Ahli Pertama',
            'username'      => '1.8.8',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 14,
            'jabatan'       => 'JF Analis Sumber Daya Manusia Aparatur Ahli Pertama',
            'username'      => '1.8.9',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 14,
            'jabatan'       => 'JF Pranata Komputer Terampil',
            'username'      => '1.8.10',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);

        // 11. Kepala Bagian Protokol dan Komunikasi Pimpinan
        User::create([
            'id_jabatan'    => 15,
            'jabatan'       => 'Kepala Bagian Protokol dan Komunikasi Pimpinan',
            'username'      => '1.9.1',
            'password'      => Hash::make('password_aman'),
            'role'          => 'kepala',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 15,
            'jabatan'       => 'Penelaah Teknis Kebijakan',
            'username'      => '1.9.2',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 15,
            'jabatan'       => 'Penata Kelola Sistem dan Teknologi Informasi',
            'username'      => '1.9.3',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 15,
            'jabatan'       => 'Fasilitator Pemerintahan',
            'username'      => '1.9.4',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 15,
            'jabatan'       => 'Pengelola Layanan Operasional',
            'username'      => '1.9.5',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 15,
            'jabatan'       => 'Pengadministrasi Perkantoran',
            'username'      => '1.9.6',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 15,
            'jabatan'       => 'Operator Layanan Operasional',
            'username'      => '1.9.7',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 15,
            'jabatan'       => 'JF Perencana Ahli Muda',
            'username'      => '1.9.8',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 15,
            'jabatan'       => 'JF Pranata Hubungan Masyarakat Ahli Muda',
            'username'      => '1.9.9',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 15,
            'jabatan'       => 'JF Perencana Ahli Pertama',
            'username'      => '1.9.10',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 15,
            'jabatan'       => 'JF Pranata Hubungan Masyarakat Ahli Pertama',
            'username'      => '1.9.11',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 15,
            'jabatan'       => 'JF Pranata Hubungan Masyarakat Penyelia',
            'username'      => '1.9.12',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 15,
            'jabatan'       => 'JF Pranata Hubungan Masyarakat Mahir',
            'username'      => '1.9.13',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 15,
            'jabatan'       => 'JF Pranata Hubungan Masyarakat Terampil',
            'username'      => '1.9.14',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 15,
            'jabatan'       => 'JF Pranata Komputer Terampil',
            'username'      => '1.9.15',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);

         // 11. Kepala Sub Bagian Protokol
        User::create([
            'id_jabatan'    => 16,
            'jabatan'       => 'Kepala Sub Bagian Protokol',
            'username'      => '1.9.1.1',
            'password'      => Hash::make('password_aman'),
            'role'          => 'kepala',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 16,
            'jabatan'       => 'Penelaah Teknis Kebijakan',
            'username'      => '1.9.1.2',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 16,
            'jabatan'       => 'Pamong Pemerintahan',
            'username'      => '1.9.1.3',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 16,
            'jabatan'       => 'Penata Keprotokolan',
            'username'      => '1.9.1.4',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
        User::create([
            'id_jabatan'    => 16,
            'jabatan'       => 'Pengelola Keprotokolan',
            'username'      => '1.9.1.5',
            'password'      => Hash::make('password_aman'),
            'role'          => 'user',
            'jabatan_staf'  => 'fungsional',
            'status'        => 'active',
        ]);
    }
}
