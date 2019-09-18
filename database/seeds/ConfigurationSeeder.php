<?php

use Illuminate\Database\Seeder;

class ConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('configuration')->insert([
        	'key' => 'nama_kaprodi',
        	'value' => 'Dr.techn. Saiful Akbar, S.T., M.T.',
        ]);

        DB::table('configuration')->insert([
        	'key' => 'nip_kaprodi',
        	'value' => '197405091998031002',
        ]);
    }
}
