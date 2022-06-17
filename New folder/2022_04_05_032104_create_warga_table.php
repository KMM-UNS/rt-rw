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
            $table->string('keluarga_id');
            $table->string('nik');
            $table->string('nama');
            $table->string('jenis_kelamin');
            $table->bigInteger('agama_id');
            $table->bigInteger('golongan_darah_id');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->bigInteger('warga_negara_id');
            $table->bigInteger('pendidikan_id');
            $table->bigInteger('pekerjaan_id');
            $table->bigInteger('status_keluarga_id');
            $table->bigInteger('status_kawin_id');
            $table->text('alamat');
            $table->bigInteger('status_warga_id');
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
        Schema::dropIfExists('warga');
    }
}
