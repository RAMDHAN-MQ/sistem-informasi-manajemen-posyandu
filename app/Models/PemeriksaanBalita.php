<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemeriksaanBalita extends Model
{
    use HasFactory;

    protected $table = 'pemeriksaan_balita';

    protected $fillable = [
        'balita_id',
        'berat',
        'tinggi',
        'tanggal_pemeriksaan',
        'riwayat_kesehatan',
        'catatan'
    ];


    public function balita()
    {
        return $this->belongsTo(Balita::class, 'balita_id');
    }
}
