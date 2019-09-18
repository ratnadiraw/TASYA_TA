<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTa1ProgressSummaryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('ta1_progress_summary', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('ta_id');
            $table->integer('jumlah_kehadiran_kelas');
            $table->integer('jumlah_kehadiran_seminar');
            $table->integer('jumlah_bimbingan');
            $table->boolean("status_pengumpulan_dokumen")->default(false);
            $table->boolean('terdaftar_seminar')->default(false);
            $table->char('nilai_akhir')->nullable();
            $table->boolean('status_lulus')->nullable();
            $table->timestamps();

            $table->foreign('ta_id')->references('id')->on('ta1_tugas_akhir')->onDelete('cascade');
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
        Schema::dropIfExists('ta1_progress_summary');
        Schema::enableForeignKeyConstraints();
    }
}
