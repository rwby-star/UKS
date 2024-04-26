<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalCheckUpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_check_up', function (Blueprint $table) {
            $table->id();
            $table->String('nama');
            $table->foreignId('id_jabatan');
            $table->enum('status',['Terverifikasi', 'Belum Terverifikasi'] )->default('Belum Terverifikasi');
            $table->String('mcu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medical_check_ups');
    }
}
