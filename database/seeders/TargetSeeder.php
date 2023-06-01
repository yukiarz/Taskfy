<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Target;
class TargetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $userIds = range(1, 5); // Assuming you have 5 user records with IDs from 1 to 5

        // Generate dummy targets
        $targets = [];

        for ($i = 1; $i <= 35; $i++) {
            $userId = $userIds[array_rand($userIds)]; // Randomly select a user ID

            $targets[] = [
                'user_id' => $userId,
                'name' => $faker->word,
                'description' => $faker->paragraph,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insert targets into the database
        Target::insert($targets);
    }
}
