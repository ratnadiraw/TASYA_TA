<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTa2SidangTable extends Migration
{
    /**
     * Membuat tabel pada database.
     *
     * @return void
     */
    public function up()
    {
    	Schema::disableForeignKeyConstraints();
    	
        Schema::create('ta2_sidang',
			function (Blueprint $table)
			{
				$table->increments('sidang_id');
				$table->unsignedInteger('ta_id');
				$table->dateTime('tanggal')->nullable();
				$table->string('ruangan')->nullable();
				$table->string('judul')->nullable();
				$table->unsignedInteger('status_pendaftaran')->default(0);
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
        Schema::dropIfExists('ta2_sidang');
        Schema::enableForeignKeyConstraints();
    }
}
