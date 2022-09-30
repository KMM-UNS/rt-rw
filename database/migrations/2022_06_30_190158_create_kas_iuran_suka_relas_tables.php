<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKasIuranSukaRelasTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kas_iuran_suka_relas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jenis_iuran_id');
            $table->date('tanggal');
            $table->unsignedBigInteger('petugas_id');
            $table->unsignedBigInteger('keluarga_id');
            $table->integer('total_biaya');
            $table->string('status');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kas_iuran_suka_relas');
    }
}
