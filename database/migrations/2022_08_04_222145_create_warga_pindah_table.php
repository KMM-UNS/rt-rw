<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWargaPindahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warga_pindah', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('warga_id');
            $table->string('alamat_tujuan');
            $table->date('tanggal_pindah');
            $table->string('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('warga_id')->references('id')->on('warga')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('warga_pindah');
    }
}
