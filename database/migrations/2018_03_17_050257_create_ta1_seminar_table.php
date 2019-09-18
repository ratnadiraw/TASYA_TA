<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTa1SeminarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('ta1_seminar', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('waktu')->nullable();
            $table->string('ruangan')->nullable();
            $table->unsignedInteger('ta_id');
            $table->string('judul')->nullable();
            $table->boolean('final')->default(false);
            $table->unsignedInteger('kloter')->nullable();
            $table->unsignedInteger('shift')->nullable();
            $table->char('nilai',2)->nullable();
            $table->char('nilai_pembimbing', 2)->nullable();
            $table->char('nilai_penguji', 2)->nullable();
            $table->binary('berkas_seminar')->nullable();
            $table->string('seminar')->nullable();
            $table->timestamps();
            $table->foreign('ta_id')->references('id')->on('ta1_tugas_akhir')->onDelete('cascade');
        });
        DB::statement("ALTER TABLE ta1_seminar MODIFY berkas_seminar MEDIUMBLOB");
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
        Schema::dropIfExists('ta1_seminar');
        Schema::enableForeignKeyConstraints();
    }
}
