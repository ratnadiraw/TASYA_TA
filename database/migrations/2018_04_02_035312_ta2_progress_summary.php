<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Ta2ProgressSummary extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('ta2_progress_summary', function (Blueprint $table) {
            $table->increments('ps_id');
            $table->unsignedInteger('ta_id');
            $table->integer('jumlah_kehadiran_kelas')->default(0);
            $table->integer('jumlah_kehadiran_seminar')->default(0);
            $table->integer('jumlah_bimbingan')->default(0);
            $table->unsignedInteger("status_pengumpulan")->default(false);
            $table->boolean('terdaftar_seminar')->default(false);
            $table->char('nilai_akhir')->nullable();
            $table->boolean('status_lulus')->default(false);
            $table->timestamps();

            $table->foreign('ta_id')->references('ta_id')->on('ta2_ta')->onDelete('cascade');
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
        Schema::dropIfExists('ta2_progress_summary');
        Schema::enableForeignKeyConstraints();
    }
}
