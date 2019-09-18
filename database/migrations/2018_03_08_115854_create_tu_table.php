<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTUTable extends Migration
{
    /**
     * Membuat tabel pada database.
     *
     * @return void
     */
    public function up()
    {
    	Schema::disableForeignKeyConstraints();
    	
        Schema::create('tu',
			function (Blueprint $table)
			{
				$table->unsignedInteger('user_id');
				$table->string('nip',30)->unique();
				$table->string('nama');
				$table->timestamps();
	
				$table->primary('user_id');
				$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('tu');
        Schema::enableForeignKeyConstraints();
    }
}
