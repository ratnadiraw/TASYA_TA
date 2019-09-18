<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDosentempTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dosentemp', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->integer('user_id');
            $table->string('nip');
            $table->string('inisial');
            $table->integer('wewenang_pembimbing');
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
        Schema::dropIfExists('dosentemp');
    }
}
