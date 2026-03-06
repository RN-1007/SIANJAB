<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RincianTugasStaf;

class RincianTugasStafSeeder extends Seeder
{
    public function run()
    {
        RincianTugasStaf::create([
            'detail_uraian_tugas_staf_id' => 1,
            'hasil_kerja'                 => 'Dokumen dan Data',
            'satuan_hasil'                => 'Dokumen',
            'target'                      => '3',
            'frekuensi'                   => '1',
            'volume'                      => '104',
            'waktu_penyelesaian'          => '15',
        ]);
        RincianTugasStaf::create([
            'detail_uraian_tugas_staf_id' => 2,
            'hasil_kerja'                 => 'Data dan Dokumen',
            'satuan_hasil'                => 'Dokumen',
            'target'                      => '1',
            'frekuensi'                   => '12',
            'volume'                      => '50',
            'waktu_penyelesaian'          => '10',
        ]);
        RincianTugasStaf::create([
            'detail_uraian_tugas_staf_id' => 27,
            'hasil_kerja'                 => 'Laporan Analisis Anggaran', 
            'satuan_hasil'                => 'Dokumen',
            'target'                      => '4', 
            'frekuensi'                   => '1', 
            'volume'                      => '4', 
            'waktu_penyelesaian'          => '120',
        ]);
        RincianTugasStaf::create([
            'detail_uraian_tugas_staf_id' => 32,
            'hasil_kerja'                 => 'Dokumen LPPD', 
            'satuan_hasil'                => 'Dokumen',
            'target'                      => '4', 
            'frekuensi'                   => '1', 
            'volume'                      => '4', 
            'waktu_penyelesaian'          => '120',
        ]);

        // Rincian untuk "Melakukan asistensi dan verifikasi RKA"
        RincianTugasStaf::create([
            'detail_uraian_tugas_staf_id' => 33,
            'hasil_kerja'                 => 'RKA Perangkat Daerah Terverifikasi', 
            'satuan_hasil'                => 'Laporan',
            'target'                      => '4', 
            'frekuensi'                   => '1', 
            'volume'                      => '4', 
            'waktu_penyelesaian'          => '120',
        ]);

    }
}
