<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Antrian extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pasien_id',
        'dokter_id',
        'poli_id',
        'no_antrian',
        'status',
    ];

    /**
     * Mendefinisikan relasi bahwa satu antrian dimiliki oleh satu Pasien.
     */
    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }

    /**
     * Mendefinisikan relasi bahwa satu antrian dimiliki oleh satu Dokter.
     */
    public function dokter()
    {
        return $this->belongsTo(Dokter::class);
    }

    /**
     * Mendefinisikan relasi bahwa satu antrian dimiliki oleh satu Poli.
     */
    public function poli()
    {
        return $this->belongsTo(Poli::class);
    }
}