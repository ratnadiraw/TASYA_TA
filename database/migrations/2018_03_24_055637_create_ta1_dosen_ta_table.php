<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTa1DosenTaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('ta1_dosen_ta', function (Blueprint $table) {
            $table->increments('dosen_ta_id');
            $table->unsignedInteger('dosen_id');
            $table->unsignedInteger('ta_id');
            $table->timestamps();

            $table->foreign('ta_id')->references('id')->on('ta1_tugas_akhir')->onDelete('cascade');
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
        Schema::dropIfExists('ta1_dosen_ta');
        Schema::enableForeignKeyConstraints();
    }
}
