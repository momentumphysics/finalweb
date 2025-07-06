<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon; // <-- TAMBAHKAN INI

class Pasien extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_mr',
        'nama',
        'no_ktp',
        'alamat',
        'no_hp',
        'tanggal_lahir',
        'jenis_kelamin',
    ];

    public function rekamMedis() {
        return $this->hasMany(RekamMedis::class);
    }

    /**
     * Accessor untuk menghitung umur pasien secara otomatis.
     * Sekarang Anda bisa memanggil $pasien->age di view.
     */
    public function getAgeAttribute(): int
    {
        return Carbon::parse($this->attributes['tanggal_lahir'])->age;
    }
}