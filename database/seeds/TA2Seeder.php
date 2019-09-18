<?php

use Illuminate\Database\Seeder;

class TA2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ta2_ta')->insertGetId([
            'mahasiswa_id' => 3,
            'topik' => 'machine learning',
        ]);

        DB::table('ta2_dosen_ta')->insertGetId([
            'dosen_id' => 4,
            'ta_id' => 1,
        ]);

        DB::table('ta2_dosen_ta')->insertGetId([
            'dosen_id' => 5,
            'ta_id' => 1,
        ]);

        DB::table('ta2_ta')->insertGetId([
            'mahasiswa_id' => 3,
            'topik' => 'oop',
            'status_lulus' => true,
        ]);

        DB::table('ta2_ta')->insertGetId([
            'mahasiswa_id' => 2,
            'topik' => 'membuat program duel yugioh',
            'status_lulus' => false,
        ]);

        DB::table('ta2_dosen_ta')->insertGetId([
            'dosen_id' => 6,
            'ta_id' => 3,
        ]);
    }
}
