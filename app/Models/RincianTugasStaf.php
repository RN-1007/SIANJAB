<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RincianTugasStaf extends Model
{
    use HasFactory;

    protected $table = 'rincian_tugas_staf';

    protected $fillable = [
        'detail_uraian_tugas_staf_id',
        'hasil_kerja',
        'satuan_hasil',
        'target',
        'frekuensi',
        'volume',
        'waktu_penyelesaian',
    ];

    public function uraianTugas()
    {
        return $this->belongsTo(DataDetailUraianTugasStaf::class, 'detail_uraian_tugas_staf_id');
    }
}
