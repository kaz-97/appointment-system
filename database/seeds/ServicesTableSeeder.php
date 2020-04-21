<?php

use App\Service;
use Illuminate\Database\Seeder;

class ServicesTableSeeder extends Seeder
{
    public function run()
    {
        $services = [
            [
                'id'             => 1,
                'name'           => 'Meeting',
            ]
        ];
        
        Service::insert($services);
    }
}
