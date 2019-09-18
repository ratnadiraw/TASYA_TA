<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateBeritaAcaraSidangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('ta2_berita_acara_sidang', function (Blueprint $table) {
            $table->increments('bas_id');
            $table->unsignedInteger('sidang_id');
            $table->string('catatan')->nullable();
            $table->string('nilai')->default('T');
            $table->unsignedInteger('status_lulus')->default(0);
            $table->timestamps();

            $table->foreign('sidang_id')->references('sidang_id')->on('ta2_sidang')->onDelete('cascade');
        });

        Schema::enableForeignKeyConstraints();

        DB::statement("ALTER TABLE ta2_berita_acara_sidang ADD lembar_finalisasi MEDIUMBLOB");
        DB::statement("ALTER TABLE ta2_berita_acara_sidang ADD berita_acara MEDIUMBLOB");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('ta2_berita_acara_sidang');
        Schema::enableForeignKeyConstraints();
    }
}
