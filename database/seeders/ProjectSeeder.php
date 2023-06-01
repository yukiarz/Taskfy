<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\User;
use App\Models\Project;
use App\Models\Contributor;
use App\Models\Activity;
use App\Models\Attc;
use App\Models\Checklist;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Generate 20 dummy projects
        $projects = [];
        $contributors = [];
        $activities = [];
        $attachments = [];
        $checklists = [];

        for ($i = 1; $i <= 20; $i++) {
            $user = User::inRandomOrder()->first();
            $project = [
                'name' => $faker->sentence,
                'description' => $faker->paragraph,
                'user_id' => $user->id,
                'start' => $faker->dateTimeBetween('-1 month', '+1 month'),
                'deadline' => $faker->dateTimeBetween('+1 month', '+3 months'),
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $projects[] = $project;

            // Generate random number of contributors for each project
            $contributorCount = rand(1, 5);

            for ($j = 0; $j < $contributorCount; $j++) {
                $user = User::inRandomOrder()->first();
                $contributors[] = [
                    'user_id' => $user->id,
                    'project_id' => $i,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                // Generate activities for each contributor
                $activityCount = rand(1, 5);

                for ($k = 0; $k < $activityCount; $k++) {
                    $activity = [
                        'project_id' => $i,
                        'user_id' => $user->id,
                        'name' => $faker->sentence,
                        'description' => $faker->paragraph,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];

                    $activities[] = $activity;
                    $activityIndex = count($activities);

                    // Generate attachments for each activity
                    $attachmentCount = rand(1, 3);

                    for ($l = 0; $l < $attachmentCount; $l++) {
                        $attachment = [
                            'activity_id' => $activityIndex,
                            'user_id' => $user->id,
                            'file' => $faker->word . '.pdf',
                            'note' => $faker->sentence,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ];

                        $attachments[] = $attachment;
                    }

                    // Generate checklists for each activity
                    $checklistCount = rand(1, 5);

                    for ($m = 0; $m < $checklistCount; $m++) {
                        $checklist = [
                            'activity_id' => $activityIndex,
                            'name' => $faker->word,
                            'description' => $faker->sentence,
                            'created_by' => $user->id,
                            'status' => $faker->randomElement([0, 1]),
                            'created_at' => now(),
                            'updated_at' => now(),
                        ];
        
                        if ($checklist['status'] === 0) {
                            $checklist['updated_by'] = null;
                        } else {
                            $contributorUserIds = Arr::pluck($contributors, 'user_id');
                            $checklist['updated_by'] = Arr::random($contributorUserIds);
                        }
        
                        $checklists[] = $checklist;
                    }
                }
            }
        }

        // Insert records into the database
        Project::insert($projects);
        Contributor::insert($contributors);
        Activity::insert($activities);
        Attc::insert($attachments);
        Checklist::insert($checklists);
    }
}
