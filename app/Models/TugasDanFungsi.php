<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TugasDanFungsi extends Model
{
    use HasFactory;

    protected $table = 'tugas_dan_fungsis';

    protected $fillable = [
        'tusi',
        'code_tusi',
        'nama_jabatan_permempan_45',
        'nama_jabatan_permempan_41'
    ];

    public function uraianTugasDanTusis()
    {
        return $this->hasMany(UraianTugasDanTusi::class, 'id_tusi');
    }
}
