<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\LogTask;

class LogTaskSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Generate dummy daily tasks
        $dailies = [];

        for ($i = 1; $i <= 5; $i++) {
            $dailies[] = [
                'user_id' => $i, 
                'today' => $faker->paragraphs(3, true),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        LogTask::insert($dailies);
    }
}
