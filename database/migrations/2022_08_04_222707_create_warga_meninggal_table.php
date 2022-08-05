<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWargaMeninggalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warga_meninggal', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('warga_id');
            $table->dateTime('waktu');
            $table->string('penyebab');
            $table->text('tempat_pemakaman');
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
        Schema::dropIfExists('warga_meninggal');
    }
}
