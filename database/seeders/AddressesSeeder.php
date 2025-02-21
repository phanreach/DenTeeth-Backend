<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Addresses;
use Faker\Factory as Faker;

class AddressesSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 50; $i++) {
            Addresses::create([ 
                'house_number' => $faker->randomNumber(),  
                'street_name'  => $faker->streetName, 
                'street_number' => $faker->randomNumber(), 
                'commune'  => $faker->citySuffix,
                'district'  => $faker->city,
                'province' => $faker->state,
                'city' => $faker->city,
                'postal_code' => $faker->postcode, 
            ]);
        }
    }
}
