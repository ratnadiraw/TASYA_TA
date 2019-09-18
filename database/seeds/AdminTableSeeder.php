<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $id = DB::table('users')->insertGetId([
            'name' => 'timta',
            'email' => 'x@x.x',
            'password' => bcrypt('123'),
        ]);

        DB::table('tim_ta')->insert([
            'user_id' => $id,
        ]);

        DB::table('months')->insert([
            'id' => '1',
            'bulan' => 'Januari',
        ]);

        DB::table('months')->insert([
            'id' => '2',
            'bulan' => 'Februari',
        ]);

        DB::table('months')->insert([
            'id' => '3',
            'bulan' => 'Maret',
        ]);

        DB::table('months')->insert([
            'id' => '4',
            'bulan' => 'April',
        ]);

        DB::table('months')->insert([
            'id' => '5',
            'bulan' => 'Mei',
        ]);

        DB::table('months')->insert([
            'id' => '6',
            'bulan' => 'Juni',
        ]);

        DB::table('months')->insert([
            'id' => '7',
            'bulan' => 'Juli',
        ]);

        DB::table('months')->insert([
            'id' => '8',
            'bulan' => 'Agustus',
        ]);

        DB::table('months')->insert([
            'id' => '9',
            'bulan' => 'September',
        ]);

        DB::table('months')->insert([
            'id' => '10',
            'bulan' => 'Oktober',
        ]);

        DB::table('months')->insert([
            'id' => '11',
            'bulan' => 'November',
        ]);

        DB::table('months')->insert([
            'id' => '12',
            'bulan' => 'Desember',
        ]);

//        $id1 = DB::table('users')->insertGetId([
//            'name' => 'Dosen',
//            'email' => 'b@b.b',
//            'password' => bcrypt('12345'),
//        ]);
//
//        DB::table('dosen')->insert([
//            'user_id' => $id1,
//            'nip' => '5555',
//            'nama' => 'Test',
//        ]);
//
//        $id2 = DB::table('users')->insertGetId([
//            'name' => 'TU',
//            'email' => 'c@c.c',
//            'password' => bcrypt('12345'),
//        ]);
//
//        DB::table('tata_usaha')->insert([
//            'user_id' => $id2,
//            'nip' => '4444',
//            'nama' => 'Test1',
//        ]);

        // DB::table('users')->insert([
        //     'name' => 'timTA',
        //     'email' => 'd@d.d',
        //     'password' => bcrypt('12345'),
        // ]);

//        $id = DB::table('users')->insertGetId([
//            'name' => 'Agus Gunawan',
//            'email' => 'agusgun@protonmail.com',
//            'password' => bcrypt('agundragon'),
//        ]);
//
//        DB::table('mahasiswa')->insert([
//            'user_id' => $id,
//            'nim' => '13515143',
//            'nama' => 'Agus Gunawan',
//            'angkatan' => 2015,
//        ]);
    }
}
