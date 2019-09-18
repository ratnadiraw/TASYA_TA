<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTa2SeminarTable extends Migration
{
    /**
     * Membuat tabel pada database.
     *
     * @return void
     */
    public function up()
    {
    	Schema::disableForeignKeyConstraints();
    	
        Schema::create('ta2_seminar',
			function (Blueprint $table)
			{
				$table->increments('seminar_id');
				$table->unsignedInteger('ta_id');
				$table->dateTime('tanggal')->nullable();
				$table->string('ruangan')->nullable();
				$table->string('judul')->nullable();
				$table->integer("status_pendaftaran");
				$table->timestamps();

				$table->foreign('ta_id')->references('ta_id')->on('ta2_ta')->onDelete('cascade');
        	}
		);
        
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Menghapus tabel pada database.
     *
     * @return void
     */
    public function down()
    {
    	Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('ta2_seminar');
        Schema::enableForeignKeyConstraints();
    }
}
