<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTa2NilaiSidangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('ta2_nilai_sidang', function (Blueprint $table) {
            $table->increments('nilai_sidang_id');
            $table->unsignedInteger('bas_id');
            $table->unsignedInteger('dosen_id');
            $table->unsignedInteger('nilai');
            $table->timestamps();

            $table->foreign('bas_id')->references('bas_id')->on('ta2_berita_acara_sidang')->onDelete('cascade');
            $table->foreign('dosen_id')->references('user_id')->on('dosen')->onDelete('cascade');
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
        Schema::dropIfExists('ta2_nilai_sidang');
        Schema::enableForeignKeyConstraints();
    }
}

