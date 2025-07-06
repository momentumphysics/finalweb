<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'nama_dokter',
        'spesialisasi',
        'no_hp',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function jadwal() {
        return $this->hasMany(JadwalDokter::class);
    }
}