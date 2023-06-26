<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VillagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    // $table->unsignedBigInteger("family_id");
    // $table->unsignedBigInteger("neighborhood_id");
    // $table->string('id_number')->unique();
    // $table->string('name');
    // $table->string('birth_place');
    // $table->date('birth_date');
    // $table->string('religion');
    // $table->enum('gender', ['L', 'P']);
    // $table->enum('marital_status', ['K', 'BK', 'CH', 'CM']);
    // $table->string('job');
    // $table->string('father_name');
    // $table->string('mother_name');
    // $table->string('education');
    public function run()
    {
        $villagers = [
            [
                "family_id" => 1,
                "neighborhood_id" => 23,
                "id_number" => "6311081712780001",
                "name" => "Murhani",
                "birth_place" => "Tebing Tinggi",
                "birth_date" => "1978-12-17",
                "religion" => "Islam",
                "gender" => "L",
                "marital_status" => "K",
                "job" => "Wiraswasta",
                "father_name" => "Abdul Raman",
                "mother_name" => "Faujiah",
                "education" => "SD",
            ],
            [
                "family_id" => 1,
                "neighborhood_id" => 23,
                "id_number" => "6311085208770001",
                "name" => "Maria Rini",
                "birth_place" => "Tebing Tinggi",
                "birth_date" => "1977-08-17",
                "religion" => "Islam",
                "gender" => "P",
                "marital_status" => "BK",
                "job" => "MRT",
                "father_name" => "Itang",
                "mother_name" => "Hatiah",
                "education" => "SLTP",
            ],
            [
                "family_id" => 1,
                "neighborhood_id" => 23,
                "id_number" => "6311081708120001",
                "name" => "Rappi Ramadan",
                "birth_place" => "Kaltim",
                "birth_date" => "2012-08-17",
                "religion" => "Islam",
                "gender" => "L",
                "marital_status" => "BK",
                "job" => "-",
                "father_name" => "Murhani",
                "mother_name" => "Maria Rini",
                "education" => "SD",
            ],
            
            [
                "family_id" => 2,
                "neighborhood_id" => 23,
                "id_number" => "6402022005750002",
                "name" => "Lukman",
                "birth_place" => "Loa Janan",
                "birth_date" => "1975-05-20",
                "religion" => "Islam",
                "gender" => "L",
                "marital_status" => "K",
                "job" => "Karyawan Swasta",
                "father_name" => "HJ.HAMSAH",
                "mother_name" => "HJ.MAIJAH",
                "education" => "SLTA",
            ]
        ];

        DB::table("villagers")->insert($villagers);
    }
}
