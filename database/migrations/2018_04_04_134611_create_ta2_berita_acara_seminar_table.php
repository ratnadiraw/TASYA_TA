<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateTa2BeritaAcaraSeminarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::disableForeignKeyConstraints();

        Schema::create('ta2_berita_acara_seminar', function (Blueprint $table) {
            $table->increments('berita_acara_id');
            $table->unsignedInteger('seminar_id');
            $table->unsignedInteger('status_lulus')->default(0);
//            $table->binary('berita_acara')->nullable();
            $table->string('catatan')->default("");
            $table->timestamps();

            $table->foreign('seminar_id')->references('seminar_id')->on('ta2_seminar')->onDelete('cascade');
        });

        Schema::enableForeignKeyConstraints();

        DB::statement("ALTER TABLE ta2_berita_acara_seminar ADD berita_acara MEDIUMBLOB");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('ta2_berita_acara_seminar');
        Schema::enableForeignKeyConstraints();
    }
}
