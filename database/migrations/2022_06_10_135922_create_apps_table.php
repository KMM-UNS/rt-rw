<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apps', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('rt');
            $table->string('rw');
            $table->char('kelurahan_id', 10);
            $table->char('kecamatan_id', 7);
            $table->char('kabupaten_id', 4);
            $table->char('provinsi_id', 2);
            $table->integer('kode_pos');
            $table->string('telepon');
            $table->string('email');
            $table->string('ketua_rt');
            $table->string('ketua_rw');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('provinsi_id')->references('id')->on('provinces')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('kabupaten_id')->references('id')->on('regencies')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('kecamatan_id')->references('id')->on('districts')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('kelurahan_id')->references('id')->on('villages')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     *
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apps');
    }
}
