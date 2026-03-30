<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\StudentProfile;
use App\Models\CompanyProfile;
use App\Models\Job;
use App\Models\Application;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->admin()->create([
            'email' => 'admin@juniordev.nl',
        ]);

        $students = User::factory(10)->student()->create();
        $students->each(fn($student) =>
            StudentProfile::factory()->create(['user_id' => $student->id])
        );

        User::factory(5)->company()->create()->each(function ($company) use ($students) {
            CompanyProfile::factory()->create(['user_id' => $company->id]);

            Job::factory(fake()->numberBetween(2, 5))->create(['user_id' => $company->id])
                ->each(function ($job) use ($students) {
                    $students->random(fake()->numberBetween(1, 5))->each(fn($student) =>
                        Application::factory()->create([
                            'job_id'  => $job->id,
                            'user_id' => $student->id,
                        ])
                    );
                });
        });
    }
}
