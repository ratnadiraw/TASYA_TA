<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsulanTopikTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('usulan_topik', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('mahasiswa_id');
            $table->timestamps();

            $table->foreign('mahasiswa_id')->references('user_id')->on('mahasiswa')->onDelete('cascade');
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
        Schema::dropIfExists('usulan_topik');
        Schema::enableForeignKeyConstraints();
    }
}
