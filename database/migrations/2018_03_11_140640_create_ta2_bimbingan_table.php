<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTa2BimbinganTable extends Migration
{
    /**
     * Membuat tabel pada database.
     *
     * @return void
     */
    public function up()
    {
    	Schema::disableForeignKeyConstraints();
    	
        Schema::create('ta2_bimbingan',
			function (Blueprint $table)
			{
				$table->increments('bimbingan_id');
				$table->unsignedInteger('ta_id');
				$table->unsignedInteger('dosen_id');
				$table->unsignedInteger('dosen_id_2')->nullable();
				$table->date('tanggal');
				$table->text('hasil_diskusi')->nullable();
				$table->text('rencana_tindak_lanjut')->nullable();
				$table->text('komentar')->nullable();
				$table->boolean('approved')->nullable();
            	$table->timestamps();

            	$table->foreign('ta_id')->references('ta_id')->on('ta2_ta')->onDelete('cascade');
            	$table->foreign('dosen_id')->references('user_id')->on('dosen')->onDelete('cascade');
                $table->foreign('dosen_id_2')->references('user_id')->on('dosen')->onDelete('cascade');
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
        Schema::dropIfExists('ta2_bimbingan');
        Schema::enableForeignKeyConstraints();
    }
}
