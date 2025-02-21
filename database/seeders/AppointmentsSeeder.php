<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Appointments;
use App\Models\User;
use App\Models\Services;
use Faker\Factory as Faker;

class AppointmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Fetch all user IDs and service IDs
        $userIds = User::pluck('id')->toArray();
        $serviceIds = Services::pluck('id')->toArray();

        if (empty($userIds) || empty($serviceIds)) {
            return; // Avoid errors if tables are empty
        }

        for ($i = 0; $i < 50; $i++) {
            Appointments::create([
                'user_id'    => $faker->randomElement($userIds),
                'service_id' => $faker->randomElement($serviceIds),
                'status'     => $faker->randomElement(['pending', 'confirmed', 'cancelled']), 
            ]);
        }
    }
}
