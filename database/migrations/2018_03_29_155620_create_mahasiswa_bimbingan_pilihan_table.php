<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMahasiswaBimbinganPilihanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('mahasiswa_bimbingan_pilihan', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('topik_id');
            $table->unsignedInteger('mahasiswa_id');
            $table->unsignedInteger('prioritas');
            $table->timestamps();

            $table->foreign('mahasiswa_id')->references('user_id')->on('mahasiswa')->onDelete('cascade');
            $table->foreign('topik_id')->references('topik_id')->on('topik')->onDelete('cascade');
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
        Schema::dropIfExists('mahasiswa_bimbingan_pilihan');
        Schema::enableForeignKeyConstraints();
    }
}
