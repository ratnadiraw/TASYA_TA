<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTa2TugasMahasiswaTable extends Migration
{
    /**
     * Membuat tabel pada database.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('ta2_tugas_mahasiswa',
            function (Blueprint $table)
            {
                $table->increments('tugas_mahasiswa_id');
                $table->unsignedInteger('tugas_id');
                $table->unsignedInteger('mahasiswa_id');
                $table->boolean('sudah_dinilai')->nullable();
                $table->timestamps();

                $table->foreign('tugas_id')->references('tugas_id')->on('ta2_tugas')->onDelete('cascade');
                $table->foreign('mahasiswa_id')->references('user_id')->on('mahasiswa')->onDelete('cascade');
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
        Schema::dropIfExists('ta2_tugas_mahasiswa');
        Schema::enableForeignKeyConstraints();
    }
}
