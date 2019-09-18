<?php

use Illuminate\Database\Seeder;

class BimbinganTA2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ta2_bimbingan')->insertGetId([
            'ta_id' => 1,
            'dosen_id' => 4,
            'tanggal' => date('y-m-d'),
            'hasil_diskusi' => 'membahas BAB 1',
            'approved' => 0,
        ]);

        DB::table('ta2_bimbingan')->insertGetId([
            'ta_id' => 1,
            'dosen_id' => 5,
            'tanggal' => date('y-m-d'),
            'hasil_diskusi' => 'membahas BAB 2',
            'approved' => 2,
        ]);

        DB::table('ta2_bimbingan')->insertGetId([
            'ta_id' => 1,
            'dosen_id' => 5,
            'tanggal' => date('y-m-d'),
            'hasil_diskusi' => 'membahas BAB 3',
            'approved' => 1,
        ]);

        DB::table('ta2_bimbingan')->insertGetId([
            'ta_id' => 1,
            'dosen_id' => 5,
            'tanggal' => date('y-m-d'),
            'hasil_diskusi' => 'membahas 4 ',
            'approved' => 0,
        ]);

        DB::table('ta2_bimbingan')->insertGetId([
            'ta_id' => 3,
            'dosen_id' => 6,
            'tanggal' => date('y-m-d'),
            'hasil_diskusi' => 'hello world',
            'approved' => 2,
        ]);
    }
}
