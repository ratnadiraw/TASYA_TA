<?php

use Illuminate\Database\Seeder;

class TempSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

////        Dosen Temporary
//        DB::table('dosentemp')->insert([
//            'nama' => "Prof. Dr.Ing.Ir. Benhard Sitohang",
//            'inisial' => "BS",
//            'wewenang_pembimbing' => 1,
//        ]);
//        DB::table('dosentemp')->insert([
//            'nama' => "Dicky Prima Satya, ST., MT.",
//            'inisial' => "DPS",
//            'wewenang_pembimbing' => 2,
//        ]);
//        DB::table('dosentemp')->insert([
//            'nama' => "Farrell Yudihartomo, ST.",
//            'inisial' => "FY",
//            'wewenang_pembimbing' => 0,
//        ]);
//
////        Kode Keilmuan Temporary
        DB::table('kodekeilmuantemp')->insert([
            'kode' => "AC",
            'areakeilmuan' => "Algorithm and Complexity",
        ]);

        DB::table('kodekeilmuantemp')->insert([
            'kode' => "CAO",
            'areakeilmuan' => "Computer Architecture and Organization",
        ]);

        DB::table('kodekeilmuantemp')->insert([
            'kode' => "CS",
            'areakeilmuan' => "Computational Science",
        ]);

        DB::table('kodekeilmuantemp')->insert([
            'kode' => "DS",
            'areakeilmuan' => "Discrete Structure",
        ]);

        DB::table('kodekeilmuantemp')->insert([
            'kode' => "GV",
            'areakeilmuan' => "Graphics and Visualization",
        ]);

        DB::table('kodekeilmuantemp')->insert([
            'kode' => "HCI",
            'areakeilmuan' => "Human-Computer Interaction",
        ]);

        DB::table('kodekeilmuantemp')->insert([
            'kode' => "IAS",
            'areakeilmuan' => "Information Assurance and Security",
        ]);

        DB::table('kodekeilmuantemp')->insert([
            'kode' => "IM",
            'areakeilmuan' => "Information Management",
        ]);

        DB::table('kodekeilmuantemp')->insert([
            'kode' => "IS",
            'areakeilmuan' => "Intelligent Systems",
        ]);

        DB::table('kodekeilmuantemp')->insert([
            'kode' => "NC",
            'areakeilmuan' => "Networking and Communication",
        ]);

        DB::table('kodekeilmuantemp')->insert([
            'kode' => "OS",
            'areakeilmuan' => "Operating Systems",
        ]);

        DB::table('kodekeilmuantemp')->insert([
            'kode' => "PBD",
            'areakeilmuan' => "Platform-Based Development",
        ]);

        DB::table('kodekeilmuantemp')->insert([
            'kode' => "PDC",
            'areakeilmuan' => "Parallel and Distributed Computing",
        ]);

        DB::table('kodekeilmuantemp')->insert([
            'kode' => "PL",
            'areakeilmuan' => "Programming Languages",
        ]);

        DB::table('kodekeilmuantemp')->insert([
            'kode' => "SDF",
            'areakeilmuan' => "Software Development Fundamentals",
        ]);

        DB::table('kodekeilmuantemp')->insert([
            'kode' => "SE",
            'areakeilmuan' => "Software Engineering",
        ]);

        DB::table('kodekeilmuantemp')->insert([
            'kode' => "SF",
            'areakeilmuan' => "Systems Fundamentals",
        ]);

        DB::table('kodekeilmuantemp')->insert([
            'kode' => "SIPP",
            'areakeilmuan' => "Social Issues and Professional Practice",
        ]);

//
//        DB::table('dosentemp')->insert([
//            'nama' => "Prof. Dr.Ing.Ir. Iping Supriana Suwardi",
//            'inisial' => "IS",
//            'wewenang_pembimbing' => 1,
//        ]);
//
//        DB::table('dosentemp')->insert([
//            'nama' => "Prof. Ir. Dwi Hendratmo W., M.Sc., Ph.D.",
//            'inisial' => "DHW",
//            'wewenang_pembimbing' => 1,
//        ]);
    }
}
