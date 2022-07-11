<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRumahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rumah', function (Blueprint $table) {
            $table->id();
            $table->string('alamat',);
            $table->string('nomor_rumah');
            $table->unsignedBigInteger('status_penggunaan_rumah_id');
            $table->unsignedBigInteger('status_hunian_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('status_penggunaan_rumah_id')->references('id')->on('status_penggunaan_rumah')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('status_hunian_id')->references('id')->on('status_hunian')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rumah');
    }
}
