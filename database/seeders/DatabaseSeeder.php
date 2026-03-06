<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            DataPdSeeder::class,
            StrukturJabatanSeeder::class,
            UserSeeder::class,
            TugasDanFungsiSeeder::class,
            DataUraianTugasStafSeeder::class,
            UraianTugasDanFungsiSeeder::class,
            DataDetailUraianTugasStafSeeder::class,
            RincianTugasStafSeeder::class,
        ]);
    }
}
