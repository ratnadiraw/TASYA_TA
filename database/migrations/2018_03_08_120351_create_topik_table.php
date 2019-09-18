<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopikTable extends Migration
{
    /**
     * Membuat tabel pada database.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('topik',
            function (Blueprint $table)
            {
                $table->increments('topik_id');
                $table->string('nama');
                $table->string('area_keilmuan');
                $table->string('area_keilmuan_spesifik')->nullable();
                $table->string('laboratorium_keahlian');
                $table->unsignedInteger('kuota');
                $table->boolean('status_buka')->default(true);
                $table->unsignedInteger('pembimbing1_id');
                $table->unsignedInteger('pembimbing2_id')->nullable();
                $table->unsignedInteger('usulan_id')->nullable();
                $table->timestamps();

                $table->foreign('pembimbing1_id')->references('user_id')->on('dosen')->onDelete('cascade');
                $table->foreign('pembimbing2_id')->references('user_id')->on('dosen')->onDelete('cascade');
                $table->foreign('usulan_id')->references('id')->on('usulan_topik')->onDelete('cascade');
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
        Schema::dropIfExists('topik');
        Schema::enableForeignKeyConstraints();
    }
}
