<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PemeriksaanBalita extends Model
{
    protected $table = 'pemeriksaan_balita';

    protected $fillable = [
        'balita_id',
        'berat',
        'tinggi',
        'riwayat_kesehatan',
    ];

    public function balita()
    {
        return $this->belongsTo(Balita::class);
    }
}
