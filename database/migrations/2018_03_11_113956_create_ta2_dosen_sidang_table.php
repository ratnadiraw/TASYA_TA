<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTa2DosenSidangTable extends Migration
{
    /**
     * Membuat tabel pada database.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ta2_dosen_sidang',
            function (Blueprint $table)
            {
                $table->increments('dosen_sidang_id');
                $table->unsignedInteger('dosen_id');
                $table->unsignedInteger('sidang_id');
                $table->timestamps();

                $table->foreign('dosen_id')->references('user_id')->on('dosen')->onDelete('cascade');
                $table->foreign('sidang_id')->references('sidang_id')->on('ta2_sidang')->onDelete('cascade');
            }
        );
    }

    /**
     * Menghapus tabel pada database.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('ta2_dosen_sidang');
        Schema::enableForeignKeyConstraints();
    }
}
