<?php

namespace Database\Seeders;

use App\Models\CategoryCar;
use Illuminate\Database\Seeder;
 
class CategoryCarTableSeeder extends Seeder
{
    public function run()
    {

        $users = [
            [

                'name'            => 'car',
                'charge_min'      => 10,
                'charge_km'       =>15,
            ],
        ];

        CategoryCar::insert($users);
    }
}
