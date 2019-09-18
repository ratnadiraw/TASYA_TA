<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTa2KelasTable extends Migration
{
    /**
     * Membuat tabel pada database.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('ta2_kelas',
            function (Blueprint $table)
            {
                $table->increments('kelas_id');
                $table->unsignedInteger('tim_ta_id');
                $table->unsignedInteger('semester');
                $table->string('tahun');
                $table->integer('status_kelas');
                $table->timestamps();

                $table->foreign('tim_ta_id')->references('user_id')->on('tim_ta')->onDelete('cascade');
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
        Schema::dropIfExists('ta2_kelas');
        Schema::enableForeignKeyConstraints();
    }
}
