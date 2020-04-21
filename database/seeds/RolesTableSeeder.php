<?php

use App\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        Role::create([
            'id' => 1,
            'role_name' => 'Admin'
        ]);

        Role::create([
            'id' => 2,
            'role_name' => 'Instructor'
        ]);

        Role::create([
            'id' => 3,
            'role_name' => 'Student'
        ]);
    }
}
