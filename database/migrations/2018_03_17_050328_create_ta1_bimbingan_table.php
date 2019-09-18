<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTa1BimbinganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('ta1_bimbingan', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('ta_id');
            $table->unsignedInteger('mahasiswa_id');
            $table->unsignedInteger('pembimbing_id');
            $table->date('tanggal');
            $table->timestamps();
            $table->foreign('mahasiswa_id')->references('user_id')->on('mahasiswa')->onDelete('cascade');
            $table->foreign('pembimbing_id')->references('user_id')->on('dosen')->onDelete('cascade');
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
        Schema::dropIfExists('ta1_bimbingan');
        Schema::enableForeignKeyConstraints();
    }
}
