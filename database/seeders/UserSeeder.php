<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // * DUSUN
        $villages = [];
        $neighborhoods =[];

        for ($i=1; $i < 6; $i++) { 
            $villages[] = [
                "name" => "Dusun $i",
                "username" => "dusun$i",
                "email" => "dusun$i@loakulukota.id",
                "phone_number" => "xxx",
                "password" => Hash::make("dusun$i"),
            ];
        }

        for ($i=1; $i < 24; $i++) { 
            $neighborhoods[] = [
                "name" => "RT $i",
                "username" => "rt$i",
                "email" => "rt$i@loakulukota.id",
                "phone_number" => "xxx",
                "password" => Hash::make("rt$i"),
            ];
        }
        $users = array_merge([
            // ADMIN
            [
                'name' => 'Admin',
                'username' => 'admin',
                'email' => 'admin@loakulukota.id',
                'phone_number' => 'xxx',
                'password' => Hash::make('admin'),
            ]
        ], $villages, $neighborhoods);
        DB::table('users')->insert($users);
    }
}
