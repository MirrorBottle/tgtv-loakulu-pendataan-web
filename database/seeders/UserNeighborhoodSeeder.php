<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserNeighborhoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admins = [];
        $neighborhoods = [];

        for ($i=1; $i < 24; $i++) { 
            $admins[] = [
                "user_id" => 1,
                "neighborhood_id" => $i
            ];

            $neighborhoods[] = [
                "user_id" => 6 + $i,
                "neighborhood_id" => $i
            ];

        }

        
        $villages = [
            ["user_id" => 2, "neighborhood_id" => 1],
            ["user_id" => 2, "neighborhood_id" => 2],
            ["user_id" => 2, "neighborhood_id" => 3],
            ["user_id" => 2, "neighborhood_id" => 4],
            ["user_id" => 2, "neighborhood_id" => 5],

            ["user_id" => 3, "neighborhood_id" => 9],
            ["user_id" => 3, "neighborhood_id" => 10],
            ["user_id" => 3, "neighborhood_id" => 11],
            ["user_id" => 3, "neighborhood_id" => 12],

            ["user_id" => 4, "neighborhood_id" => 6],
            ["user_id" => 4, "neighborhood_id" => 7],
            ["user_id" => 4, "neighborhood_id" => 13],
            ["user_id" => 4, "neighborhood_id" => 14],
            ["user_id" => 4, "neighborhood_id" => 15],

            ["user_id" => 5, "neighborhood_id" => 16],
            ["user_id" => 5, "neighborhood_id" => 17],
            ["user_id" => 5, "neighborhood_id" => 18],
            ["user_id" => 5, "neighborhood_id" => 19],

            ["user_id" => 6, "neighborhood_id" => 20],
            ["user_id" => 6, "neighborhood_id" => 21],
            ["user_id" => 6, "neighborhood_id" => 22],
            ["user_id" => 6, "neighborhood_id" => 23],

        ];

        
    
        $data = array_merge($admins, $villages, $neighborhoods);

        DB::table('user_neighborhoods')->insert($data);
    }
}
