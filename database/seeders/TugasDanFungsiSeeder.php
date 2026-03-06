<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TugasDanFungsi;

class TugasDanFungsiSeeder extends Seeder
{
    public function run(): void
    {
        // Asisten Pemerintahan dan Kesejahteraan Rakyat
        TugasDanFungsi::create([
            'code_tusi' => 101,
            'tusi' => 'Melaksanakan penyiapan perumusan kebijakan, pengoordinasian, pembinaan, dan monitoring-evaluasi di bidang pemerintahan umum, otonomi daerah, kerja sama, dan administrasi kewilayahan.',
            'nama_jabatan_permempan_45' => 'Analis Kebijakan Ahli Madya',
            'nama_jabatan_permempan_41' => 'Kepala Bagian Pemerintahan'
        ]);

        TugasDanFungsi::create([
            'code_tusi' => 102,
            'tusi' => 'Melaksanakan penyiapan perumusan produk hukum daerah, memberikan bantuan dan pertimbangan hukum, serta melaksanakan dokumentasi dan informasi hukum.',
            'nama_jabatan_permempan_45' => 'Analis Hukum Ahli Madya',
            'nama_jabatan_permempan_41' => 'Kepala Bagian Hukum'
        ]);

        TugasDanFungsi::create([
            'code_tusi' => 103,
            'tusi' => 'Melaksanakan penyiapan perumusan kebijakan, pengoordinasian, pembinaan, dan monitoring-evaluasi di bidang kesejahteraan sosial, keagamaan, pendidikan, kebudayaan, dan kesehatan.',
            'nama_jabatan_permempan_45' => 'Analis Kebijakan Ahli Madya',
            'nama_jabatan_permempan_41' => 'Kepala Bagian Kesejahteraan Rakyat'
        ]);

        TugasDanFungsi::create([
            'code_tusi' => 104,
            'tusi' => 'Melaksanakan penyiapan perumusan kebijakan, pengoordinasian, pembinaan, dan monitoring-evaluasi di bidang ekonomi makro, BUMD, dan pengembangan usaha daerah.',
            'nama_jabatan_permempan_45' => 'Analis Kebijakan Ahli Madya',
            'nama_jabatan_permempan_41' => 'Kepala Bagian Perekonomian'
        ]);

        TugasDanFungsi::create([
            'code_tusi' => 105,
            'tusi' => 'Melaksanakan dukungan penyelenggaraan pengadaan barang/jasa pemerintah daerah.',
            'nama_jabatan_permempan_45' => 'Pejabat Fungsional Pengelola Pengadaan Barang/Jasa Ahli Muda',
            'nama_jabatan_permempan_41' => 'Kepala Bagian Pengadaan Barang dan Jasa'
        ]);

        TugasDanFungsi::create([
            'code_tusi' => 106,
            'tusi' => 'Melaksanakan penyiapan pengoordinasian perumusan kebijakan dan pemantauan penyelenggaraan administrasi pembangunan daerah.',
            'nama_jabatan_permempan_45' => 'Analis Kebijakan Ahli Madya',
            'nama_jabatan_permempan_41' => 'Kepala Bagian Administrasi Pembangunan'
        ]);

        // Sekretariat DPRD
        TugasDanFungsi::create([
            'code_tusi' => 201,
            'tusi' => 'Melaksanakan penyiapan dukungan administrasi kepegawaian, keuangan, kerumahtanggaan, dan perlengkapan untuk kelancaran tugas Sekretariat DPRD dan Pimpinan serta Anggota DPRD.',
            'nama_jabatan_permempan_45' => 'Analis SDM Aparatur Ahli Muda',
            'nama_jabatan_permempan_41' => 'Kepala Bagian Umum dan Kepegawaian'
        ]);

        TugasDanFungsi::create([
            'code_tusi' => 202,
            'tusi' => 'Melaksanakan penyiapan fasilitasi penyelenggaraan rapat-rapat DPRD dan penyusunan produk hukum DPRD.',
            'nama_jabatan_permempan_45' => 'Analis Hukum Ahli Muda',
            'nama_jabatan_permempan_41' => 'Kepala Bagian Persidangan dan Perundang-undangan'
        ]);

        TugasDanFungsi::create([
            'code_tusi' => 203,
            'tusi' => 'Melaksanakan penyiapan dukungan fasilitasi untuk pelaksanaan fungsi anggaran dan fungsi pengawasan DPRD.',
            'nama_jabatan_permempan_45' => 'Analis Kebijakan Ahli Pertama',
            'nama_jabatan_permempan_41' => 'Kepala Bagian Keuangan dan Pengawasan'
        ]);

        TugasDanFungsi::create([
            'code_tusi' => 204,
            'tusi' => 'Melaksanakan urusan hubungan masyarakat, keprotokolan, publikasi, dan aspirasi masyarakat.',
            'nama_jabatan_permempan_45' => 'Pranata Humas Ahli Muda',
            'nama_jabatan_permempan_41' => 'Kepala Bagian Humas dan Protokol'
        ]);

        // Badan Daerah
        TugasDanFungsi::create([
            'code_tusi' => 301,
            'tusi' => 'Melaksanakan fungsi penunjang urusan pemerintahan bidang perencanaan pembangunan daerah.',
            'nama_jabatan_permempan_45' => 'Perencana Ahli Madya',
            'nama_jabatan_permempan_41' => 'Kepala Badan Perencanaan Pembangunan Daerah'
        ]);

        TugasDanFungsi::create([
            'code_tusi' => 302,
            'tusi' => 'Melaksanakan fungsi penunjang urusan pemerintahan bidang pengelolaan keuangan dan aset daerah.',
            'nama_jabatan_permempan_45' => 'Analis Keuangan Pusat dan Daerah Ahli Madya',
            'nama_jabatan_permempan_41' => 'Kepala Badan Pengelola Keuangan dan Aset Daerah'
        ]);

        // ID: 13 (Untuk Kepala Bagian Tata Pemerintahan)
        TugasDanFungsi::create([
            'code_tusi' => 107,
            'tusi' => 'Melaksanakan penyiapan perumusan kebijakan daerah, pengoordinasian, pemantauan dan evaluasi di bidang tata pemerintahan.',
            'nama_jabatan_permempan_45' => 'Analis Kebijakan Ahli Muda',
            'nama_jabatan_permempan_41' => 'Kepala Bagian Tata Pemerintahan'
        ]);
        // ID: 14 (Untuk Kepala Bagian Umum Sekretariat DPRD)
        TugasDanFungsi::create([
            'code_tusi' => 205,
            'tusi' => 'Melaksanakan pengelolaan urusan tata usaha, kepegawaian, keuangan, rumah tangga dan perlengkapan di lingkungan Sekretariat DPRD.',
            'nama_jabatan_permempan_45' => 'Perencana Ahli Muda',
            'nama_jabatan_permempan_41' => 'Kepala Bagian Umum Sekretariat DPRD'
        ]);
        // ID: 15 (Untuk Kepala Bidang Anggaran)
        TugasDanFungsi::create([
            'code_tusi' => 303,
            'tusi' => 'Melaksanakan penyiapan bahan perumusan kebijakan teknis, pembinaan, dan pelaksanaan di bidang anggaran.',
            'nama_jabatan_permempan_45' => 'Analis Anggaran Ahli Muda',
            'nama_jabatan_permempan_41' => 'Kepala Bidang Anggaran'
        ]);
        // ID: 16 (Untuk Kepala Bidang Perencanaan)
        TugasDanFungsi::create([
            'code_tusi' => 304,
            'tusi' => 'Melaksanakan koordinasi dan sinkronisasi perencanaan, pengendalian, dan evaluasi pembangunan daerah.',
            'nama_jabatan_permempan_45' => 'Perencana Ahli Madya',
            'nama_jabatan_permempan_41' => 'Kepala Bidang Perencanaan, Pengendalian dan Evaluasi Pembangunan Daerah'
        ]);

    }
}
