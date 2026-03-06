<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_jabatan',
        'username',
        'role',
        'jabatan_staf',
        'status',
        'jabatan',
        'password'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected function semuaDetailTugas(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->uraianTugasStaf->semuaDetailTugas ?? collect(),
        );
    }

    public function strukturJabatan()
    {
        return $this->belongsTo(StrukturJabatan::class, 'id_jabatan');
    }


    public function uraianTugasStaf()
    {
        return $this->hasOne(DataUraianTugasStaf::class, 'id_user');
    }
}
