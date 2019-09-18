<?php

use Illuminate\Database\Seeder;

class TA2SeminarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ta2_seminar')->insertGetId([
            'ta_id' => 1,
            'tanggal' => date('y-m-d'),
            'ruangan' => "7606",
            'status_pendaftaran' => 2,
        ]);
    }
}
