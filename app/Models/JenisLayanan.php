<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisLayanan extends Model
{
    protected $table = 'jenis_layanan';

    protected $fillable = [
        'jenis',
    ];

    public function layanan()
    {
        return $this->hasMany(Layanan::class, 'jenis_id');
    }
}
