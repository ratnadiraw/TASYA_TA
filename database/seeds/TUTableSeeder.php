<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TUTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $id = DB::table('users')->insertGetId([
            'name' => 'Admin',
            'email' => 'admin@taifitb.com',
            'password' => bcrypt('admin'),
        ]);

        DB::table('tu')->insert([
            'user_id' => $id,
            'nip' => 1234,
            'nama' => "Admin TU",
        ]);

        // DB::table('users')->insert([
        //     'name' => 'Admin',
        //     'email' => 'admin@taifitb.com',
        //     'password' => bcrypt('admin'),
        // ]);

        // DB::table('users')->insert([
        //     'name' => 'Mahasiswa',
        //     'email' => 'a@a.a',
        //     'password' => bcrypt('12345'),
        // ]);

        // DB::table('users')->insert([
        //     'name' => 'Dosen',
        //     'email' => 'b@b.b',
        //     'password' => bcrypt('12345'),
        // ]);

        // DB::table('users')->insert([
        //     'name' => 'TU',
        //     'email' => 'c@c.',
        //     'password' => bcrypt('12345'),
        // ]);

        // DB::table('users')->insert([
        //     'name' => 'timTA',
        //     'email' => 'd@d.d',
        //     'password' => bcrypt('12345'),
        // ]);
    }
}
