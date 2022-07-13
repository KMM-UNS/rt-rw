<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKasIuranAgendasTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kas_iuran_agendas', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_iuran_id');
            $table->date('tanggal');
            $table->string('petugas');
            $table->string('warga');
            $table->string('pos');
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
        Schema::dropIfExists('kas_iuran_agendas');
    }
}
