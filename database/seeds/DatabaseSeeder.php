<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        /* Super Admin */
//        $this->call(AdminTableSeeder::class);
        //$this->call(MahasiswaTASeeder::class);
        //$this->call(DosenTASeeder::class);
        $this->call(TUTableSeeder::class);
//        $this->call(TempSeeder::class);
        //$this->call(TahunAjaranSeeder::class);
    }
}
