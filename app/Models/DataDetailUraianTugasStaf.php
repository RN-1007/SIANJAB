<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataDetailUraianTugasStaf extends Model
{
    protected $table = 'data_detail_uraian_tugas_stafs';

    protected $fillable = [
        'id_uraian_tugas_tusi',
        'uraian_tugas_staf',
        'abk_ideal',
        'abk_berlebih',
        'kategori_jabatan',
        'data_pendukung_sebelumnya',
        'data_pendukung',
        'type_data_pendukung_sebelumnya',
        'type_data_pendukung',
        'status',
        'catatan_mahasiswa',
    ];

    public function rincianTugas()
    {
        return $this->hasOne(RincianTugasStaf::class, 'detail_uraian_tugas_staf_id');
    }

    public function uraianTugas()
    {
        return $this->belongsTo(UraianTugasDanTusi::class, 'id_uraian_tugas_tusi');
    }

    use HasFactory;
}
