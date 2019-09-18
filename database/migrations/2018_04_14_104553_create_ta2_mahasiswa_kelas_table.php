<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTa2MahasiswaKelasTable extends Migration
{
    /**
     * Membuat tabel pada database.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('ta2_mahasiswa_kelas',
            function (Blueprint $table)
            {
                $table->increments('mahasiswa_kelas_id');
                $table->unsignedInteger('mahasiswa_id');
                $table->unsignedInteger('kelas_id');
                $table->integer('jumlah_kehadiran_kelas')->default(0);
                $table->timestamps();

                $table->foreign('mahasiswa_id')->references('user_id')->on('mahasiswa')->onDelete('cascade');
                $table->foreign('kelas_id')->references('kelas_id')->on('ta2_kelas')->onDelete('cascade');
                //$table->foreign('kehadiran_kelas')->references('jumlah_kehadiran_kelas')->on('ta2_progress_summary')->onDelete('cascade');
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
        Schema::dropIfExists('ta2_mahasiswa_kelas');
        Schema::enableForeignKeyConstraints();
    }
}
