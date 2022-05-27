<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKasIuranSukaRelasTable extends Migration
{
    public function up()
    {
        Schema::create('kas_iuran_suka_relas', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_iuran_id');
            $table->string('bulan');
            $table->string('tahun');
            $table->string('petugas');
            $table->string('pemberi');
            $table->integer('total_biaya');
            // $table->string('bukti_pembayaran');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kas_iuran_suka_relas');
    }
}
