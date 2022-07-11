<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_surat');
            $table->unsignedbigInteger('warga_id');
            $table->unsignedbigInteger('keperluan_surat_id');
            $table->date('tanggal_pengajuan');
            $table->date('tanggal_disetujui')->nullable();
            $table->string('keterangan')->nullable();
            $table->unsignedBigInteger('status_surat_id');
            $table->unsignedbigInteger('createable_id');
            $table->text('createable_type');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('warga_id')->references('id')->on('warga')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('keperluan_surat_id')->references('id')->on('keperluan_surat')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('status_surat_id')->references('id')->on('status_surat')->onUpdate('cascade')->onDelete('restrict');
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
        Schema::dropIfExists('surat');
    }
}
