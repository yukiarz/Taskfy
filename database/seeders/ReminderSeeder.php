<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reminder;
use App\Models\UserReminder;
use Faker\Factory as Faker;

class ReminderSeeder extends Seeder
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

        // Generate dummy reminders
        $reminders = [];
        $userReminders = [];

        for ($i = 1; $i <= 35; $i++) {
            $reminder = [
                'description' => $faker->sentence,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $reminders[] = $reminder;

            // Randomly assign the reminder to one or more users
            $userIdsCount = rand(1, count($userIds));
            $userIdsCopy = $userIds; // Create a copy of user IDs array

            for ($j = 0; $j < $userIdsCount; $j++) {
                $userIdIndex = array_rand($userIdsCopy);
                $userId = $userIdsCopy[$userIdIndex];

                $userReminders[] = [
                    'user_id' => $userId,
                    'reminder_id' => $i,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                // Remove the selected user ID from the array copy to avoid duplicate assignments
                unset($userIdsCopy[$userIdIndex]);
            }
        }

        // Insert reminders into the database
        Reminder::insert($reminders);

        // Insert user reminders into the database
        UserReminder::insert($userReminders);
    }
}
