<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPd extends Model
{
    use HasFactory;

    protected $table = 'data_pds';

    protected $fillable = [
        'nama_pd',
    ];

    public function strukturJabatans()
    {
        return $this->hasMany(StrukturJabatan::class, 'id_pd');
    }
}
