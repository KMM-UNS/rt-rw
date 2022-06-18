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
            $table->bigInteger('keluarga_id');
            $table->bigInteger('createable_id');
            $table->text('createable_type');
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
        Schema::dropIfExists('tamu');
    }
}
