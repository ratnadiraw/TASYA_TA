<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MahasiswaTASeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        $id = DB::table('users')->insertGetId([
//            'name' => 'Agus Gunawan',
//            'email' => 'a@a.com',
//            'password' => bcrypt('agundragon'),
//        ]);
//
//        DB::table('mahasiswa')->insert([
//            'user_id' => $id,
//            'nim' => '13515143',
//            'nama' => 'Agus Gunawan',
//            'angkatan' => 2015,
//            'current_ta2_id' => 3,
//        ]);

        $id = DB::table('users')->insertGetId([
            'name' => 'Rizki Ihza Parama',
            'email' => 'r@r.com',
            'password' => bcrypt('pram1997'),
        ]);

        DB::table('mahasiswa')->insert([
            'user_id' => $id,
            'nim' => '13515104',
            'nama' => 'Rizki Ihza Parama',
            'angkatan' => 2015,
            'current_ta2_id' => 1,
        ]);
    }
}