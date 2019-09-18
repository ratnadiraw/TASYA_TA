<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTa2TugasKelasTable extends Migration
{
    /**
     * Membuat tabel pada database.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('ta2_tugas_kelas',
            function (Blueprint $table)
            {
                $table->increments('tugas_kelas_id');
                $table->unsignedInteger('tugas_id');
                $table->unsignedInteger('kelas_id');
                $table->timestamps();

                $table->foreign('tugas_id')->references('tugas_id')->on('ta2_tugas')->onDelete('cascade');
                $table->foreign('kelas_id')->references('kelas_id')->on('ta2_kelas')->onDelete('cascade');
            }
        );

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Menghapus tabel pada database.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('ta2_tugas_kelas');
        Schema::enableForeignKeyConstraints();
    }
}
