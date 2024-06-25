<?php

namespace Database\Factories;

use App\Models\Trip;
use App\Models\Location;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TripFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [

            'lat' =>$this->faker->latitude(31.2001,31.265375 ) , // Latitude range for Alexandria
            'long' =>  $this->faker->longitude(29.8839,  30.017010) , // Latitude range for Alexandria
            // 'longitude' => $this->faker->longitude(29.8839, 30.1317), // Longitude range for Alexandria
            // Add more attributes as needed
        ];
    }
}
