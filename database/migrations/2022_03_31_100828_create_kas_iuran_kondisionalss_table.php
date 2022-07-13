<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKasIuranKondisionalssTable extends Migration
{
    public function up()
    {
        Schema::create('kas_iuran_kondisionalss', function (Blueprint $table) {
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

    public function down()
    {
        Schema::dropIfExists('kas_iuran_kondisionals');
    }
}
