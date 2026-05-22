<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IbuHamil extends Model
{
    protected $table = 'ibuhamil';

    protected $fillable = [
        'nama',
        'nik',
        'tempat_lahir',
        'tgl_lahir',
        'alamat',
    ];

    public function pemeriksaan()
    {
        return $this->hasMany(PemeriksaanIbuHamil::class);
    }
}
