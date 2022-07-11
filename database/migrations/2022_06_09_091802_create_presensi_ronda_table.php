<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePresensiRondaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presensi_ronda', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jadwal_ronda_id');
            $table->unsignedBigInteger('hari_id');
            $table->date('tanggal');
            $table->string('kehadiran');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('jadwal_ronda_id')->references('id')->on('jadwal_ronda')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('hari_id')->references('id')->on('hari')->onUpdate('cascade')->onDelete('restrict');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('presensi_ronda');
    }
}
