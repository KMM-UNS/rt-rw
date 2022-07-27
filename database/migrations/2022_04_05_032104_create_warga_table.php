<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWargaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warga', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('keluarga_id');
            $table->string('nik')->unique();
            $table->string('nama');
            $table->string('jenis_kelamin');
            $table->unsignedBigInteger('agama_id');
            $table->unsignedBigInteger('golongan_darah_id');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->unsignedBigInteger('warga_negara_id');
            $table->unsignedBigInteger('pendidikan_id');
            $table->unsignedBigInteger('pekerjaan_id');
            $table->unsignedBigInteger('status_keluarga_id');
            $table->unsignedBigInteger('status_kawin_id');
            $table->text('alamat');
            $table->unsignedBigInteger('status_warga_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('keluarga_id')->references('id')->on('keluarga')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('agama_id')->references('id')->on('agama')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('golongan_darah_id')->references('id')->on('golongan_darah')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('warga_negara_id')->references('id')->on('warga_negara')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('pendidikan_id')->references('id')->on('pendidikan')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('pekerjaan_id')->references('id')->on('pekerjaan')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('status_keluarga_id')->references('id')->on('status_keluarga')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('status_kawin_id')->references('id')->on('status_kawin')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('status_warga_id')->references('id')->on('status_warga')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('warga');
    }
}
