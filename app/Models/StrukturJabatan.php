<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StrukturJabatan extends Model
{
    use HasFactory;

    protected $table = 'struktur_jabatans';

    protected $fillable = [
        'id_pd',
        'parent_id',
        'nama_jabatan',
        'tipe_jabatan',
        'kelas_jabatan',
    ];

    public function dataPd()
    {
        return $this->belongsTo(DataPd::class, 'id_pd');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'id_jabatan');
    }

    public function children()
    {
        return $this->hasMany(StrukturJabatan::class, 'parent_id');
    }

    /**
     * ✅ RELASI KUNCI: Mendapatkan semua 'staf' (User) yang berada di bawah jabatan ini,
     * melalui jabatan-jabatan bawahannya.
     */
    public function stafUsers()
    {
        return $this->hasManyThrough(
            User::class,                // Model tujuan akhir yang ingin kita dapatkan
            StrukturJabatan::class,     // Model perantara
            'parent_id',                // Foreign key di tabel perantara (struktur_jabatans)
            'id_jabatan',               // Foreign key di tabel tujuan (users)
            'id',                       // Local key di tabel ini (struktur_jabatans)
            'id'                        // Local key di tabel perantara (struktur_jabatans)
        );
    }
}
