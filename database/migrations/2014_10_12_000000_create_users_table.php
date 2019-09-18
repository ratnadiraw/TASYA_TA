<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
	/**
	 * Membuat tabel pada database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::disableForeignKeyConstraints();
		
		Schema::create('users',
			function(Blueprint $table)
			{
				$table->increments('id');
				$table->string('name');
				$table->string('email', 50)->unique();
				$table->string('password');
				$table->rememberToken();
				$table->timestamps();
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
		Schema::dropIfExists('users');
		Schema::enableForeignKeyConstraints();
	}
}
