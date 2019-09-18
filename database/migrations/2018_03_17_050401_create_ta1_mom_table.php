<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTa1MomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('ta1_mom', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('bimbingan_id');
            $table->string('hasil_diskusi');
            $table->string('tindak_lanjut');
            $table->date('tangal_bimbingan_berikutnya');
            $table->string('komentar')->nullable();
            $table->boolean('status_persetujuan')->nullable();
            $table->timestamps();
            $table->foreign('bimbingan_id')->references('id')->on('ta1_bimbingan')->onDelete('cascade');
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
        Schema::dropIfExists('ta1_mom');
        Schema::enableForeignKeyConstraints();
    }
}
