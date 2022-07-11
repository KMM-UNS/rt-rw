<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTamuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tamu', function (Blueprint $table) {
            $table->id();
            $table->integer('jumlah');
            $table->string('nama');
            $table->string('alamat');
            $table->string('hubungan');
            $table->date('tanggal_tiba');
            $table->integer('lama_menetap');
            $table->unsignedBigInteger('keluarga_id');
            $table->unsignedBigInteger('createable_id');
            $table->text('createable_type');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('keluarga_id')->references('id')->on('keluarga')->onUpdate('cascade')->onDelete('restrict');
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
        Schema::dropIfExists('tamu');
    }
}
