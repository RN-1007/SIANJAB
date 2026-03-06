<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataUraianTugasStaf extends Model
{
    protected $table = 'data_uraian_tugas_stafs';

    protected $fillable = [
        'id_user',
        'kelas_jabatan',
        'pns',
        'non_pns',
        'pppk',
        'cpns',
        'jumlah_eksisting',
        'pemenuhan_pegawai',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function uraianTugasDanTusi()
    {
        return $this->hasMany(UraianTugasDanTusi::class, 'id_uraian_tugas_staf');
    }

    /**
     * ==========================================================
     * TAMBAHKAN FUNGSI INI UNTUK MENGHITUNG TUGAS
     * ==========================================================
     * Mendapatkan semua DETAIL uraian tugas melalui tabel UraianTugasDanTusi.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function semuaDetailTugas()
    {
        return $this->hasManyThrough(
            DataDetailUraianTugasStaf::class, // Model tujuan akhir
            UraianTugasDanTusi::class,       // Model perantara
            'id_uraian_tugas_staf',          // Foreign key di tabel perantara
            'id_uraian_tugas_tusi',          // Foreign key di tabel tujuan
            'id',                            // Local key di tabel ini
            'id'                             // Local key di tabel perantara
        );
    }

    use HasFactory;
}
