<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTa2DosenTATable extends Migration
{
    /**
     * Membuat tabel pada database.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ta2_dosen_ta',
            function (Blueprint $table)
            {
                $table->increments('dosen_ta_id');
                $table->unsignedInteger('dosen_id');
                $table->unsignedInteger('ta_id');
                $table->timestamps();

                $table->foreign('ta_id')->references('ta_id')->on('ta2_ta')->onDelete('cascade');
                $table->foreign('dosen_id')->references('user_id')->on('dosen')->onDelete('cascade');
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
        Schema::dropIfExists('ta2_dosen_ta');
        Schema::enableForeignKeyConstraints();
    }
}
