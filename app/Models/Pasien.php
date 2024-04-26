<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $table = 'pasien';
    protected $guarded = [];

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class,'id_jabatan', 'id');
    }

    public function data_sakit()
    {
        return $this->hasMany(DataSakit::class);
    }
}
