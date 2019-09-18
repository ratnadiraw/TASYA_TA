<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DosenTASeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $id1 = DB::table('users')->insertGetId([
            'name' => 'Judhi Santoso',
            'email' => 'j@s.com',
            'password' => bcrypt('bpkjs'),
        ]);

        DB::table('dosen')->insert([
            'user_id' => $id1,
            'nip' => '111111',
            'nama' => 'Judhi Santoso',
            'kelompok_keahlian' => 'IRK'
        ]);

        $id2 = DB::table('users')->insertGetId([
            'name' => 'Fazat Nur Azizah',
            'email' => 'f@f.com',
            'password' => bcrypt('ibufazat'),
        ]);

        DB::table('dosen')->insert([
            'user_id' => $id2,
            'nip' => '222222',
            'nama' => 'Fazat Nur Azizah',
            'kelompok_keahlian' => 'Basdat'
        ]);
    }
}
