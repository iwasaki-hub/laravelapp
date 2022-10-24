<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeopleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param =[
            "name" => "mario",
            "mail" => "mario@gmail.com",
            "age" => 12,
        ];
        DB::table("people")->insert($param);

        $param =[
            "name" => "luigi",
            "mail" => "luigi@gmail.com",
            "age" => 35,
        ];
        DB::table("people")->insert($param);

        $param =[
            "name" => "pinokio",
            "mail" => "pinokio@gmail.com",
            "age" => 50,
        ];
        DB::table("people")->insert($param);

        $param =[
            "name" => "peach",
            "mail" => "peach@gmail.com",
            "age" => 60,
        ];
        DB::table("people")->insert($param);
    }
}
