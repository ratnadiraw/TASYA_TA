<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMahasiswaTable extends Migration
{
    /**
     * Membuat tabel pada database.
     *
     * @return void
     */
    public function up()
    {
    	Schema::disableForeignKeyConstraints();
    	
        Schema::create('mahasiswa',
			function (Blueprint $table)
			{
				$table->unsignedInteger('user_id');
				$table->string('nim',8)->unique();
				$table->string('nama');
				$table->unsignedInteger('angkatan');
				$table->unsignedInteger('jumlah_sks_lulus');
				$table->boolean('lulus_ta_1')->default('0');

				$table->unsignedInteger('current_ta2_id')->nullable();

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
        Schema::dropIfExists('mahasiswa');
        Schema::enableForeignKeyConstraints();
    }
}
