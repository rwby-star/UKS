<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalCheckUp extends Model
{
    use HasFactory;
    
    protected $table = 'medical_check_up';
    protected $guarded = [];

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class,'id_jabatan', 'id');
    }
}
