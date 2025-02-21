<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Services; // Corrected model reference
use Faker\Factory as Faker;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 50; $i++) {
            Services::create([ // Updated model name
                'service_name' => $faker->word,  // Generates a single word for service name
                'description'  => $faker->sentence, // Generates a sentence for description
                'cost'         => $faker->randomFloat(2, 10, 100), 
            ]);
        }
    }
}
