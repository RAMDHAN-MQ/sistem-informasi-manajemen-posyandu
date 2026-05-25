<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    protected $table = 'layanan';

    protected $fillable = [
        'user_id',
        'judul_kegiatan',
        'lokasi',
        'tanggal',
        'waktu_mulai',
        'waktu_selesai',
        'keterangan',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}