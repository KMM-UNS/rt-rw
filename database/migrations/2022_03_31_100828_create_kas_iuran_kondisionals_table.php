<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKasIuranKondisionalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kas_iuran_kondisionals', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_iuran');
            $table->string('bulan');
            $table->string('tahun');
            $table->string('penerima');
            $table->string('pemberi');
            $table->string('total_biaya');
            $table->string('bukti_pembayaran');
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
        Schema::dropIfExists('kas_iuran_kondisionals');
    }
}
