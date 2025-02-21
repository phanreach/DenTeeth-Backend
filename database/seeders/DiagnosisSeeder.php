<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Diagnosis;

class DiagnosisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 50; $i++) {
            Diagnosis::create([
                'user_id' => $faker->numberBetween(1, 10), 
                'symptom_data_id' => $faker->numberBetween(1, 5), 
                'photo' => $faker->imageUrl(640, 480, 'medical'), // Generates a random image URL
            ]);
        }
    }
}
