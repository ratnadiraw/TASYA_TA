<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTa2PengumumanTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::disableForeignKeyConstraints();
		Schema::create('ta2_pengumuman', function (Blueprint $table) {
			$table->increments('id');
			$table->string('judul');
			$table->text('konten');
			$table->date('tanggal_mulai');
			$table->date('tanggal_berakhir');
			$table->unsignedInteger('timTA_id');
			$table->timestamps();
			$table->foreign('timTA_id')->references('user_id')->on('tim_ta')->onDelete('cascade');
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
		Schema::dropIfExists('ta2_pengumuman');
		Schema::enableForeignKeyConstraints();
	}
}