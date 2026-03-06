<?php

namespace Database\Seeders;

use App\Models\UraianTugasDanTusi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UraianTugasDanFungsiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UraianTugasDanTusi::create([
            'id_tusi' => 1, // Tusi 101
            'id_uraian_tugas_staf' => 1,
        ]);
        UraianTugasDanTusi::create([
            'id_tusi' => 4, // Tusi 101
            'id_uraian_tugas_staf' => 1,
        ]);
        UraianTugasDanTusi::create([
            'id_tusi' => 5, // Tusi 101
            'id_uraian_tugas_staf' => 1,
        ]);
        UraianTugasDanTusi::create([
            'id_tusi' => 2,
            'id_uraian_tugas_staf' => 2,
        ]);
        UraianTugasDanTusi::create([
            'id_tusi' => 3,
            'id_uraian_tugas_staf' => 3,
        ]);
        UraianTugasDanTusi::create([
            'id_tusi' => 7,
            'id_uraian_tugas_staf' => 4,
        ]);
        UraianTugasDanTusi::create([
            'id_tusi' => 8,
            'id_uraian_tugas_staf' => 5,
        ]);
        // LANJUTAN 
        UraianTugasDanTusi::create([
            'id_tusi' => 9, 
            'id_uraian_tugas_staf' => 6, 
        ]);
        
        UraianTugasDanTusi::create([
            'id_tusi' => 10, 
            'id_uraian_tugas_staf' => 7, 
        ]);
       
        UraianTugasDanTusi::create([
            'id_tusi' => 11, 
            'id_uraian_tugas_staf' => 8, 
        ]);

        UraianTugasDanTusi::create([
            'id_tusi' => 12, 
            'id_uraian_tugas_staf' => 9,
        ]);
               
        UraianTugasDanTusi::create([
            'id_tusi' => 13, 
            'id_uraian_tugas_staf' => 10,
        ]);
        
        UraianTugasDanTusi::create([
            'id_tusi' => 14, 
            'id_uraian_tugas_staf' => 11, 
        ]);
        UraianTugasDanTusi::create([
            'id_tusi' => 15, 
            'id_uraian_tugas_staf' => 12,
        ]);
        
        UraianTugasDanTusi::create([
            'id_tusi' => 16, 
            'id_uraian_tugas_staf' => 13,
        ]);

    }
}
