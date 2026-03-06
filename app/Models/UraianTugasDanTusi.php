<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UraianTugasDanTusi extends Model
{
    use HasFactory;

    protected $table = 'uraian_tugas_dan_tusis';

    protected $fillable = [
        'id_tusi',
        'id_uraian_tugas_staf',
    ];
    public function tusi()
    {
        return $this->belongsTo(TugasDanFungsi::class, 'id_tusi');
    }

    public function dataUraianTugasStaf()
    {
        return $this->belongsTo(DataUraianTugasStaf::class, 'id_uraian_tugas_staf');
    }

    public function uraianTugasStaf()
    {
        return $this->hasMany(DataDetailUraianTugasStaf::class, 'id_detail_uraian_tugas_tusi');
    }
}
