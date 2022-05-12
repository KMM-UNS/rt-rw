<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKasIuranKondisionalsTable extends Migration
{
    public function up()
    {
        Schema::create('kas_iuran_kondisionals', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_iuran_id');
            $table->string('bulan');
            $table->string('tahun');
            $table->string('nama_petugas');
            $table->string('pemberi');
            $table->string('total_biaya');
            // $table->string('bukti_pembayaran');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kas_iuran_kondisionals');
    }
}