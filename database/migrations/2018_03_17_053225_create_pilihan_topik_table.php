<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePilihanTopikTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('pilihan_topik', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('ta_id');
            $table->unsignedInteger('prioritas1')->nullable();
            $table->unsignedInteger('prioritas2')->nullable();
            $table->unsignedInteger('prioritas3')->nullable();
            $table->foreign('ta_id')->references('id')->on('ta1_tugas_akhir')->onDelete('cascade');
            $table->foreign('prioritas1')->references('id')->on('topiktemp')->onDelete('cascade');
            $table->foreign('prioritas2')->references('id')->on('topiktemp')->onDelete('cascade');
            $table->foreign('prioritas3')->references('id')->on('topiktemp')->onDelete('cascade');
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
        Schema::dropIfExists('pilihan_topik');
        Schema::enableForeignKeyConstraints();
    }
}
