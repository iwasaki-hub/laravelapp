<?php

namespace Database\Seeders;

use App\Models\Restdata;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RestdataTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'message' => 'Google Japan',
            'url' => 'https://www.google.co.jp/',
        ];
        $restdata = new Restdata;
        $restdata->fill($param)->save();

        $param = [
            'message' => 'Yahoo Japan',
            'url' => 'https://www.yahoo.co.jp/',
        ];
        $restdata = new Restdata;
        $restdata->fill($param)->save();

        $param = [
            'message' => 'Apple Japan',
            'url' => 'https://www.apple.com/jp/',
        ];
        $restdata = new Restdata;
        $restdata->fill($param)->save();


    }
}
