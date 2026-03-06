<?php

namespace Database\Seeders;

use App\Models\DataPd;
use Illuminate\Database\Seeder;


class DataPdSeeder extends Seeder
{
    public function run()
    {
        DataPd::create(['nama_pd' => 'Sekretariat Daerah']);
        DataPd::create(['nama_pd' => 'Sekretariat DPRD']);
        DataPd::create(['nama_pd' => 'Badan Daerah']);
    }
}
