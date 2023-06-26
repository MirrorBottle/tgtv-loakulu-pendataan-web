<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FamilySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $families = [
            [
                "neighborhood_id" => 23,
                "number" => "64022310130007",
                "head_family" => "-",
                "total_member" => 3,
                "address" => "-"
            ],
            [
                "neighborhood_id" => 23,
                "number" => "640202107110005",
                "head_family" => "-",
                "total_member" => 1,
                "address" => "-"
            ],
        ];

        DB::table("families")->insert($families);
    }
}
