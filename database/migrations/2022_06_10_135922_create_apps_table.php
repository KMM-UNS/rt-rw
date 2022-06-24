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
            $table->bigInteger('kelurahan_id');
            $table->bigInteger('kecamatan_id');
            $table->bigInteger('kabupaten_id');
            $table->bigInteger('provinsi_id');
            $table->integer('kode_pos');
            $table->string('telepon');
            $table->string('email');
            $table->string('ketua_rt');
            $table->string('ketua_rw');
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
        Schema::dropIfExists('apps');
    }
}
