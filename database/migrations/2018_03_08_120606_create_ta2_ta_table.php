<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTa2TaTable extends Migration
{
    /**
     * Membuat tabel pada database.
     *
     * @return void
     */
    public function up()
    {
    	Schema::disableForeignKeyConstraints();
    	
        Schema::create('ta2_ta',
			function (Blueprint $table)
			{
				$table->increments('ta_id');
				$table->unsignedInteger('mahasiswa_id');

                $table->unsignedInteger('topik_id')->nullable();
				$table->string('topik')->nullable();
                $table->string('judul')->default("belum ada judul");

				$table->unsignedInteger('mahasiswa_daftar_seminar')->default(0);
				$table->unsignedInteger('mahasiswa_daftar_sidang')->default(0);

				$table->unsignedInteger('lulus_seminar')->default(false);
				$table->string('nilai')->default("T");
				$table->unsignedInteger('status_lulus')->default(false);
				$table->timestamps();

                $table->unsignedInteger('tahun_ajaran_id')->nullable();

                $table->foreign('mahasiswa_id')->references('user_id')->on('mahasiswa')->onDelete('cascade');
                $table->foreign('topik_id')->references('topik_id')->on('topik')->onDelete('cascade');
                $table->foreign('tahun_ajaran_id')->references('id')->on('tahun_ajaran')->onDelete('cascade');
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
        Schema::dropIfExists('ta2_ta');
        Schema::enableForeignKeyConstraints();
    }
}
