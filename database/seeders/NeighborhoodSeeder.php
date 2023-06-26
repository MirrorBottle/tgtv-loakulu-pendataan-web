<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NeighborhoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $neighborhoods = [];
        for ($i=1; $i < 24; $i++) { 
            $neighborhoods[] = [
                "name" => "RT $i",
                "address" => "-",
            ];
        }
        DB::table('neighborhoods')->insert($neighborhoods);

    }
}
