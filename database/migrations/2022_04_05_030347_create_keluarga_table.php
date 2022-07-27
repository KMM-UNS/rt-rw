<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeluargaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keluarga', function (Blueprint $table) {
            $table->id();
            $table->string('no_kk')->unique();
            $table->string('kepala_keluarga');
            $table->unsignedBigInteger('rumah_id')->nullable();
            $table->string('telp');
            $table->unsignedBigInteger('status_tinggal_id');
            $table->unsignedBigInteger('createable_id');
            $table->text('createable_type');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('rumah_id')->references('id')->on('rumah')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('status_tinggal_id')->references('id')->on('status_tinggal')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('createable_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('keluarga');
    }
}
