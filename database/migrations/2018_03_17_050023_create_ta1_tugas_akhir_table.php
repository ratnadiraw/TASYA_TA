<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTa1TugasAkhirTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('ta1_tugas_akhir', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('mahasiswa_id');
            $table->unsignedInteger('topik_id')->nullable();
            $table->string('nama_topik')->nullable();
            $table->boolean('status_checkout')->default(false);
            $table->unsignedInteger('tahun_ajaran_id')->nullable();
            $table->timestamps();
            $table->foreign('mahasiswa_id')->references('user_id')->on('mahasiswa')->onDelete('cascade');
            $table->foreign('topik_id')->references('topik_id')->on('topik')->onDelete('cascade');
            $table->foreign('tahun_ajaran_id')->references('id')->on('tahun_ajaran')->onDelete('cascade');
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
        Schema::dropIfExists('ta1_tugas_akhir');
        Schema::enableForeignKeyConstraints();
    }
}
