<?php

use Illuminate\Database\Seeder;

class TahunAjaranSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('tahun_ajaran')->insert([
			'semester' => 1,
			'tahun' => '2018',
			'tanggal_mulai' => '2018-01-20',
			'tanggal_selesai' => '2018-05-20'
		]);
	}
}