<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Activity;
class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Generate dummy daily tasks
        $dailies = [];

        for ($i = 1; $i <= 10; $i++) {
            $dailies[] = [
                'user_id' => $i, // Assuming you have user records with IDs from 1 to 10
                'tasks' => $faker->paragraphs(3, true), // Generate multiple paragraphs of text as tasks
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insert daily tasks into the database
        Daily::insert($dailies);
    }
}
