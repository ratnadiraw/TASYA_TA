<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTa1DaftarTugasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('ta1_daftar_tugas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('tugas_id');
            $table->unsignedInteger('progress_id');
            $table->boolean('status_pengumpulan')->default(false);
            $table->timestamps();
            $table->foreign('tugas_id')->references('id')->on('ta1_tugas')->onDelete('cascade');
            $table->foreign('progress_id')->references('id')->on('ta1_progress_summary')->onDelete('cascade');
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
        Schema::dropIfExists('ta1_daftar_tugas');
        Schema::enableForeignKeyConstraints();
    }
}
