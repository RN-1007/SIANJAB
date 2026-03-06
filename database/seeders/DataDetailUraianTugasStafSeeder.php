<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DataDetailUraianTugasStaf;

class DataDetailUraianTugasStafSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Data ini terhubung dengan 'id' dari DataDataDetailUraianTugasStafSeeder
        // Setiap DataDataDetailUraianTugasStaf memiliki 2 uraian tugas staf

        // ==================================================================
        // Uraian untuk DataDataDetailUraianTugasStaf ID: 1 (User 1, Tusi 101)
        // ==================================================================
        DataDetailUraianTugasStaf::create([
            'id_uraian_tugas_tusi'      => 1,
            'uraian_tugas_staf'         => 'Mengumpulkan dan mengolah data Laporan Penyelenggaraan Pemerintahan Daerah (LPPD) dari Perangkat Daerah terkait.',
            'abk_ideal'                 => 5,
            'abk_berlebih' => 0,
            'kategori_jabatan'          => 'Jabatan Fungsional',
            'status'                    => 'sudah',
            'catatan_mahasiswa'         => 'sudah terverifikasi'
        ]);
        DataDetailUraianTugasStaf::create([
            'id_uraian_tugas_tusi'      => 1,
            'uraian_tugas_staf'         => 'Menyiapkan konsep surat, nota dinas, dan telaahan staf terkait isu-isu pemerintahan umum (misalnya: kependudukan, ketertiban umum).',
            'abk_ideal'                 => 5,
            'abk_berlebih' => 0,
            'kategori_jabatan'          => 'Jabatan Fungsional',
            'status'                    => 'belum',
            'catatan_mahasiswa'         => ''
        ]);
        DataDetailUraianTugasStaf::create([
            'id_uraian_tugas_tusi'      => 1,
            'uraian_tugas_staf'         => 'Menyiapkan draf naskah perjanjian kerja sama (MoU) antar daerah.',
            'abk_ideal'                 => 5,
            'abk_berlebih' => 0,
            'kategori_jabatan'          => 'Jabatan Fungsional',
            'status'                    => 'belum',
            'catatan_mahasiswa'         => ''
        ]);
        DataDetailUraianTugasStaf::create([
            'id_uraian_tugas_tusi'      => 2,
            'uraian_tugas_staf'         => 'Melakukan kajian literatur dan studi banding untuk penyusunan Naskah Akademik Rancangan Peraturan Daerah (Raperda).',
            'abk_ideal'                 => 5,
            'abk_berlebih' => 0,
            'kategori_jabatan'          => 'Jabatan Fungsional',
            'status'                    => 'belum',
            'catatan_mahasiswa'         => ''
        ]);

        // ==================================================================
        // Uraian untuk DataDataDetailUraianTugasStaf ID: 2 (User 1, Tusi 102)
        // ==================================================================
        DataDetailUraianTugasStaf::create([
            'id_uraian_tugas_tusi'      => 2,
            'uraian_tugas_staf'         => 'Menyiapkan bahan pembinaan dan supervisi manajerial bagi kepala sekolah.',
            'abk_ideal'                 => 4,
            'abk_berlebih' => 0,
            'kategori_jabatan'          => 'Jabatan Fungsional',
            'status'                    => 'belum',
            'catatan_mahasiswa'         => ''
        ]);
        DataDetailUraianTugasStaf::create([
            'id_uraian_tugas_tusi'      => 2,
            'uraian_tugas_staf'         => 'Mengelola administrasi usulan penilaian angka kredit bagi guru.',
            'abk_ideal'                 => 4,
            'abk_berlebih' => 0,
            'kategori_jabatan'          => 'Jabatan Fungsional',
            'status'                    => 'sudah',
            'catatan_mahasiswa'         => 'Memfasilitasi proses kenaikan pangkat guru.'
        ]);

        // ==================================================================
        // Uraian untuk DataDataDetailUraianTugasStaf ID: 3 (User 1, Tusi 103)
        // ==================================================================
        DataDetailUraianTugasStaf::create([
            'id_uraian_tugas_tusi'      => 3,
            'uraian_tugas_staf'         => 'Mengumpulkan dan menganalisis data hasil ujian sekolah sebagai bahan evaluasi.',
            'abk_ideal'                 => 3,
            'abk_berlebih' => 1,
            'kategori_jabatan'          => 'Jabatan Fungsional',
            'status'                    => 'sudah',
            'catatan_mahasiswa'         => 'Menganalisis tren capaian pembelajaran siswa.'
        ]);

        // ==================================================================
        // Uraian untuk DataDataDetailUraianTugasStaf ID: 4 (User 2, Tusi 201)
        // ==================================================================
        DataDetailUraianTugasStaf::create([
            'id_uraian_tugas_tusi'      => 4,
            'uraian_tugas_staf'         => 'Menyusun kerangka acuan kerja (KAK) untuk program penyuluhan kesehatan ibu dan anak.',
            'abk_ideal'                 => 3,
            'abk_berlebih' => 0,
            'kategori_jabatan'          => 'Jabatan Fungsional',
            'status'                    => 'belum',
            'catatan_mahasiswa'         => ''
        ]);
        DataDetailUraianTugasStaf::create([
            'id_uraian_tugas_tusi'      => 4,
            'uraian_tugas_staf'         => 'Menganalisis data surveilans penyakit menular sebagai dasar penyusunan rencana kontingensi.',
            'abk_ideal'                 => 3,
            'abk_berlebih' => 0,
            'kategori_jabatan'          => 'Jabatan Fungsional',
            'status'                    => 'sudah',
            'catatan_mahasiswa'         => 'Memantau perkembangan penyakit untuk respon cepat.'
        ]);

        // ==================================================================
        // Uraian untuk DataDataDetailUraianTugasStaf ID: 5 (User 2, Tusi 202)
        // ==================================================================
        DataDetailUraianTugasStaf::create([
            'id_uraian_tugas_tusi'      => 5,
            'uraian_tugas_staf'         => 'Melakukan investigasi lapangan terhadap laporan kasus penyakit potensial wabah.',
            'abk_ideal'                 => 5,
            'abk_berlebih' => 0,
            'kategori_jabatan'          => 'Jabatan Fungsional',
            'status'                    => 'belum',
            'catatan_mahasiswa'         => ''
        ]);
        DataDetailUraianTugasStaf::create([
            'id_uraian_tugas_tusi'      => 5,
            'uraian_tugas_staf'         => 'Melaksanakan inspeksi kesehatan lingkungan pada tempat-tempat umum.',
            'abk_ideal'                 => 5,
            'abk_berlebih' => 0,
            'kategori_jabatan'          => 'Jabatan Fungsional',
            'status'                    => 'sudah',
            'catatan_mahasiswa'         => 'Memastikan standar kesehatan lingkungan terpenuhi.'
        ]);

        // ==================================================================
        // Uraian untuk DataDataDetailUraianTugasStaf ID: 6 (User 2, Tusi 203)
        // ==================================================================
        DataDetailUraianTugasStaf::create([
            'id_uraian_tugas_tusi'      => 5,
            'uraian_tugas_staf'         => 'Melakukan verifikasi data klaim Jaminan Kesehatan Nasional (JKN) di fasilitas kesehatan.',
            'abk_ideal'                 => 2,
            'abk_berlebih' => 1,
            'kategori_jabatan'          => 'Jabatan Fungsional',
            'status'                    => 'sudah',
            'catatan_mahasiswa'         => 'Mengelola aspek administrasi pembiayaan kesehatan.'
        ]);
        DataDetailUraianTugasStaf::create([
            'id_uraian_tugas_tusi'      => 5,
            'uraian_tugas_staf'         => 'Menyusun laporan ketersediaan obat dan alat kesehatan di gudang farmasi.',
            'abk_ideal'                 => 2,
            'abk_berlebih' => 1,
            'kategori_jabatan'          => 'Jabatan Fungsional',
            'status'                    => 'sudah',
            'catatan_mahasiswa'         => 'Memastikan ketersediaan sumber daya farmasi.'
        ]);

        // ==================================================================
        // Uraian untuk DataDataDetailUraianTugasStaf ID: 7 (User 3, Tusi 301)
        // ==================================================================
        DataDetailUraianTugasStaf::create([
            'id_uraian_tugas_tusi'      => 6,
            'uraian_tugas_staf'         => 'Melakukan survei teknis dan pengukuran lapangan untuk perencanaan jalan baru.',
            'abk_ideal'                 => 6,
            'abk_berlebih' => 3,
            'kategori_jabatan'          => 'Jabatan Fungsional',
            'status'                    => 'sudah',
            'catatan_mahasiswa'         => 'Pengumpulan data primer untuk desain teknis.'
        ]);
        DataDetailUraianTugasStaf::create([
            'id_uraian_tugas_tusi'      => 6,
            'uraian_tugas_staf'         => 'Menyusun gambar rencana teknis (DED) untuk proyek rehabilitasi saluran irigasi.',
            'abk_ideal'                 => 6,
            'abk_berlebih' => 3,
            'kategori_jabatan'          => 'Jabatan Fungsional',
            'status'                    => 'sudah',
            'catatan_mahasiswa'         => 'Membuat visualisasi teknis dari rencana konstruksi.'
        ]);

        // ==================================================================
        // Uraian untuk DataDataDetailUraianTugasStaf ID: 8 (User 3, Tusi 302)
        // ==================================================================
        DataDetailUraianTugasStaf::create([
            'id_uraian_tugas_tusi'      => 6,
            'uraian_tugas_staf'         => 'Menyiapkan dokumen lelang dan spesifikasi teknis untuk proyek pemeliharaan jalan.',
            'abk_ideal'                 => 8,
            'abk_berlebih' => 1,
            'kategori_jabatan'          => 'Jabatan Fungsional',
            'status'                    => 'sudah',
            'catatan_mahasiswa'         => 'Memastikan proses pengadaan sesuai dengan regulasi.'
        ]);
        DataDetailUraianTugasStaf::create([
            'id_uraian_tugas_tusi'      => 6,
            'uraian_tugas_staf'         => 'Melakukan pengujian laboratorium terhadap material konstruksi seperti sampel aspal dan beton.',
            'abk_ideal'                 => 8,
            'abk_berlebih' => 1,
            'kategori_jabatan'          => 'Jabatan Fungsional',
            'status'                    => 'sudah',
            'catatan_mahasiswa'         => 'Kontrol kualitas material untuk menjamin kekuatan konstruksi.'
        ]);

        // ==================================================================
        // Uraian untuk DataDataDetailUraianTugasStaf ID: 9 (User 3, Tusi 303)
        // ==================================================================
        DataDetailUraianTugasStaf::create([
            'id_uraian_tugas_tusi'      => 6,
            'uraian_tugas_staf'         => 'Melakukan pengawasan harian di lapangan terhadap progres pekerjaan kontraktor.',
            'abk_ideal'                 => 10,
            'abk_berlebih' => 0,
            'kategori_jabatan'          => 'Jabatan Fungsional',
            'status'                    => 'sudah',
            'catatan_mahasiswa'         => 'Memastikan pekerjaan sesuai spesifikasi dan jadwal.'
        ]);
        DataDetailUraianTugasStaf::create([
            'id_uraian_tugas_tusi'      => 7,
            'uraian_tugas_staf'         => 'Memeriksa dan menyetujui laporan kemajuan (opname) pekerjaan sebagai dasar pembayaran termin.',
            'abk_ideal'                 => 10,
            'abk_berlebih' => 0,
            'kategori_jabatan'          => 'Jabatan Fungsional',
            'status'                    => 'sudah',
            'catatan_mahasiswa'         => 'Menghitung volume pekerjaan yang telah diselesaikan.'
        ]);

        // ==================================================================
        // Uraian untuk DataDataDetailUraianTugasStaf ID: 10 (User 4, Tusi 401)
        // ==================================================================
        DataDetailUraianTugasStaf::create([
            'id_uraian_tugas_tusi'      => 7,
            'uraian_tugas_staf'         => 'Menganalisis data kebutuhan pegawai dan menyusun draf usulan formasi ASN.',
            'abk_ideal'                 => 2,
            'abk_berlebih' => 0,
            'kategori_jabatan'          => 'Jabatan Fungsional',
            'status'                    => 'sudah',
            'catatan_mahasiswa'         => 'Merencanakan kebutuhan sumber daya manusia pemerintah.'
        ]);
        DataDetailUraianTugasStaf::create([
            'id_uraian_tugas_tusi'      => 7,
            'uraian_tugas_staf'         => 'Melaksanakan verifikasi berkas administrasi pada seleksi penerimaan Calon ASN (CASN).',
            'abk_ideal'                 => 2,
            'abk_berlebih' => 0,
            'kategori_jabatan'          => 'Jabatan Fungsional',
            'status'                    => 'sudah',
            'catatan_mahasiswa'         => 'Tahap awal dalam proses rekrutmen pegawai baru.'
        ]);

        // ==================================================================
        // Uraian untuk DataDataDetailUraianTugasStaf ID: 11 (User 4, Tusi 402)
        // ==================================================================
        DataDetailUraianTugasStaf::create([
            'id_uraian_tugas_tusi'      => 7,
            'uraian_tugas_staf'         => 'Mengidentifikasi kebutuhan pengembangan kompetensi (diklat) bagi pegawai.',
            'abk_ideal'                 => 1,
            'abk_berlebih' => 0,
            'kategori_jabatan'          => 'Jabatan Fungsional',
            'status'                    => 'sudah',
            'catatan_mahasiswa'         => 'Dasar untuk merancang program pelatihan yang efektif.'
        ]);
        DataDetailUraianTugasStaf::create([
            'id_uraian_tugas_tusi'      => 7,
            'uraian_tugas_staf'         => 'Menyiapkan bahan pertimbangan teknis untuk usulan mutasi dan promosi pegawai.',
            'abk_ideal'                 => 1,
            'abk_berlebih' => 0,
            'kategori_jabatan'          => 'Jabatan Fungsional',
            'status'                    => 'sudah',
            'catatan_mahasiswa'         => 'Mendukung proses manajemen talenta dan suksesi.'
        ]);

        // ==================================================================
        // Uraian untuk DataDataDetailUraianTugasStaf ID: 12 (User 4, Tusi 403)
        // ==================================================================
        DataDetailUraianTugasStaf::create([
            'id_uraian_tugas_tusi'      => 7,
            'uraian_tugas_staf'         => 'Melakukan pemutakhiran data pada Sistem Aplikasi Pelayanan Kepegawaian (SAPK).',
            'abk_ideal'                 => 2,
            'abk_berlebih' => 0,
            'kategori_jabatan'          => 'Jabatan Fungsional',
            'status'                    => 'sudah',
            'catatan_mahasiswa'         => 'Menjaga validitas dan akurasi data induk kepegawaian.'
        ]);
        DataDetailUraianTugasStaf::create([
            'id_uraian_tugas_tusi'      => 7,
            'uraian_tugas_staf'         => 'Memproses administrasi usulan pensiun dan pemberhentian pegawai.',
            'abk_ideal'                 => 2,
            'abk_berlebih' => 0,
            'kategori_jabatan'          => 'Jabatan Fungsional',
            'status'                    => 'sudah',
            'catatan_mahasiswa'         => 'Memastikan hak-hak kepegawaian terpenuhi hingga akhir masa kerja.'
        ]);

        // Detail untuk Tusi ID: 8 (Kepala Bagian Keuangan dan Pengawasan DPRD)
        DataDetailUraianTugasStaf::create([
            'id_uraian_tugas_tusi'      => 8,
            'uraian_tugas_staf'         => 'Menyusun dan menganalisis laporan realisasi anggaran Sekretariat DPRD.',
            'abk_ideal'                 => 4,
            'abk_berlebih'              => 0,
            'kategori_jabatan'          => 'Jabatan Struktural',
            'status'                    => 'sudah',
            'catatan_mahasiswa'         => 'Laporan triwulanan sudah diserahkan kepada pimpinan.'
        ]);

        // Detail untuk Tusi ID: 9 (Kepala Bagian Humas dan Protokol DPRD)
        DataDetailUraianTugasStaf::create([
            'id_uraian_tugas_tusi'      => 9,
            'uraian_tugas_staf'         => 'Mengelola kegiatan keprotokolan dan hubungan media untuk pimpinan dan anggota DPRD.',
            'abk_ideal'                 => 5,
            'abk_berlebih'              => 0,
            'kategori_jabatan'          => 'Jabatan Struktural',
            'status'                    => 'sudah',
            'catatan_mahasiswa'         => ''
        ]);

        // Detail untuk Tusi ID: 10 (Kepala Bappeda)
        DataDetailUraianTugasStaf::create([
            'id_uraian_tugas_tusi'      => 10,
            'uraian_tugas_staf'         => 'Mengkoordinasikan penyusunan Rencana Pembangunan Jangka Menengah Daerah (RPJMD).',
            'abk_ideal'                 => 8,
            'abk_berlebih'              => 0,
            'kategori_jabatan'          => 'Jabatan Struktural',
            'status'                    => 'sudah',
            'catatan_mahasiswa'         => 'Finalisasi draf RPJMD untuk dibawa ke rapat paripurna.'
        ]);

        // Detail untuk Tusi ID: 11 (Kepala BPKAD)
        DataDetailUraianTugasStaf::create([
            'id_uraian_tugas_tusi'      => 11,
            'uraian_tugas_staf'         => 'Melakukan verifikasi dan pengesahan Dokumen Pelaksanaan Anggaran (DPA) SKPD.',
            'abk_ideal'                 => 9,
            'abk_berlebih'              => 0,
            'kategori_jabatan'          => 'Jabatan Struktural',
            'status'                    => 'sudah',
            'catatan_mahasiswa'         => 'Verifikasi DPA untuk 10 SKPD telah selesai.'
        ]);

        DataDetailUraianTugasStaf::create([
            'id_uraian_tugas_tusi'      => 12,
            'uraian_tugas_staf'         => 'Memfasilitasi penyusunan Laporan Penyelenggaraan Pemerintahan Daerah (LPPD) Kabupaten.',
            'abk_ideal'                 => 6,
            'abk_berlebih'              => 0,
            'kategori_jabatan'          => 'Jabatan Struktural',
            'status'                    => 'sudah',
            'catatan_mahasiswa'         => 'LPPD telah diserahkan ke provinsi.'
        ]);
        // Detail untuk Tusi ID: 13 (Kepala Bagian Umum DPRD)
        DataDetailUraianTugasStaf::create([
            'id_uraian_tugas_tusi'      => 13,
            'uraian_tugas_staf'         => 'Mengkoordinasikan penyusunan Rencana Kebutuhan Barang Milik Daerah (RKBMD) untuk Sekretariat DPRD.',
            'abk_ideal'                 => 7,
            'abk_berlebih'              => 0,
            'kategori_jabatan'          => 'Jabatan Struktural',
            'status'                    => 'sudah',
            'catatan_mahasiswa'         => 'Sudah diinput ke dalam sistem.'
        ]);
        // Detail untuk Tusi ID: 14 (Kepala Bidang Anggaran)
        DataDetailUraianTugasStaf::create([
            'id_uraian_tugas_tusi'      => 14,
            'uraian_tugas_staf'         => 'Melakukan asistensi dan verifikasi Rencana Kerja dan Anggaran (RKA) Perangkat Daerah.',
            'abk_ideal'                 => 5,
            'abk_berlebih'              => 0,
            'kategori_jabatan'          => 'Jabatan Struktural',
            'status'                    => 'sudah',
            'catatan_mahasiswa'         => ''
        ]);
        // Detail untuk Tusi ID: 15 (Kepala Bidang Perencanaan)
        DataDetailUraianTugasStaf::create([
            'id_uraian_tugas_tusi'      => 15,
            'uraian_tugas_staf'         => 'Menyelenggarakan Musyawarah Perencanaan Pembangunan (Musrenbang) Rencana Kerja Pemerintah Daerah (RKPD).',
            'abk_ideal'                 => 8,
            'abk_berlebih'              => 0,
            'kategori_jabatan'          => 'Jabatan Struktural',
            'status'                    => 'sudah',
            'catatan_mahasiswa'         => 'Laporan hasil Musrenbang telah disusun.'
        ]);
    }
}
