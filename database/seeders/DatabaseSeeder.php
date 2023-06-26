<?php

namespace Database\Seeders;

use App\Models\ApprovalHirarcy;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(UserSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserRoleSeeder::class);
        $this->call(NeighborhoodSeeder::class);
        $this->call(UserNeighborhoodSeeder::class);
        $this->call(FamilySeeder::class);
        $this->call(VillagerSeeder::class);

    }
}
