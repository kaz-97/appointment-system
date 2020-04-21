<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'name'           => 'Administrator',
                'email'          => 'admin@learninghub.com',
                'password'       => Hash::make('password'),
            ],
            [
                'id'             => 2,
                'name'           => 'Richard Kerr',
                'email'          => 'richardkerr@learninghub.com',
                'password'       => Hash::make('password'),
            ],
            
            [
                'id'             => 3,
                'name'           => 'Kerry McKinney',
                'email'          => 'kerrymckinney@learninghub.com',
                'password'       => Hash::make('password'),
            ], 
        ];
        
        User::insert($users);
    }
}