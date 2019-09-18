<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTa1SuratTugasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('ta1_surat_tugas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('ta_id');
            $table->string('nomor_kop_surat');
            $table->date('tanggal_terbit');
            $table->timestamps();
            $table->foreign('ta_id')->references('id')->on('ta1_tugas_akhir')->onDelete('cascade');
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('surat_tugas');
        Schema::enableForeignKeyConstraints();
    }
}
