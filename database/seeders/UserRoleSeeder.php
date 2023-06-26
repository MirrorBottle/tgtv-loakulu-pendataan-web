<?php

namespace Database\Seeders;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;
class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::find(1);
        $user = Role::find(2);

        $userAdmin = User::find(1)->assignRole($admin);

        for ($i=2; $i < 30; $i++) {
            User::find($i)->assignRole($user);
        }

    }
}
