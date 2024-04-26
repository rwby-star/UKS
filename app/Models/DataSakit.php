<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataSakit extends Model
{
    use HasFactory;

    protected $table = 'data_sakit';
    protected $guarded = [];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'id_pasien', 'id');
    }

    public function petugas()
    {
        return $this->belongsTo(Petugas::class,'id_petugas', 'id');
    }
}
