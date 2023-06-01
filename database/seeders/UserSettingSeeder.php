<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserSetting;
use Faker\Factory as Faker;
class UserSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $userSettings = [];

        for ($i = 1; $i <= 5; $i++) {
            $userSettings[] = [
                'user_id' => $i,
                'phone' => $faker->phoneNumber,
                'position' => $faker->jobTitle,
                'level' => $faker->randomElement([1, 2]),
                'profile' => $faker->optional()->imageUrl(),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insert user settings into the database
        UserSetting::insert($userSettings);
    }
}
