<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalRondaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal_ronda', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ronda_id');
            $table->unsignedBigInteger('warga_id');
            $table->unsignedBigInteger('hari_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('ronda_id')->references('id')->on('ronda')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('warga_id')->references('id')->on('warga')->onUpdate('cascade')->onDelete('restrict');
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
        Schema::dropIfExists('jadwal_ronda');
    }
}
