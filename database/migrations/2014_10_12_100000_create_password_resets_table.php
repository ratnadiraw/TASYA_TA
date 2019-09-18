<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePasswordResetsTable extends Migration
{
	/**
	 * Membuat tabel pada database.
	 *
	 * @return void
	 */
    public function up()
    {
    	Schema::disableForeignKeyConstraints();
    	
        Schema::create('password_resets',
			function (Blueprint $table)
			{
				$table->string('email', 50)->unique();
				$table->string('token');
				$table->timestamp('created_at')->nullable();
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
        Schema::dropIfExists('password_resets');
        Schema::enableForeignKeyConstraints();
    }
}
