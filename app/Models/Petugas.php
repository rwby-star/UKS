<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Petugas extends Model
{
    use HasFactory;

    protected $table = 'petugas';
    protected $guarded = [];

    public function data_sakit()
    {
        return $this->hasMany(DataSakit::class);
    }

    public function riwayat_penyakit()
    {
        return $this->hasMany(RiwayatPenyakit::class);
    }
}
