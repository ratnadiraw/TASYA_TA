<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopiktempTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topiktemp', function (Blueprint $table) {
            $table->increments('id');
            $table->string('areakeilmuan');
            $table->string('areakeilmuanspesifik')->nullable();
            $table->text('topik');
            $table->longText('deskripsi');
            $table->integer('quota');
            $table->integer('pembimbing1');
            $table->integer('pembimbing2')->nullable();
            $table->string('bidanglain')->nullable();
            $table->string('laboratorium');
            $table->string('keterangan');
            $table->integer('idDosen');
            $table->integer('tahun');
            $table->integer('semester');
            $table->integer('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('topiktemp');
    }
}
