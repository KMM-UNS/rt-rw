<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeluargasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keluargas', function (Blueprint $table) {
            $table->id();
            $table->string('no_kk');
            $table->string('warga');
            $table->string('rumah_id')->nullable();
            $table->string('telp');
            $table->bigInteger('status_tinggal')->nullable();
            $table->bigInteger('createable_id')->nullable();
            $table->text('createable_type')->nullable();
            $table->string('pos_tagihan');
            $table->string('status');
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
        Schema::dropIfExists('keluargas');
    }
}