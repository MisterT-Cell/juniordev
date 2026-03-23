<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\StudentProfile;
use App\Models\CompanyProfile;
use App\Models\Assignment;
use App\Models\Application;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin (één vaste inlogaccount voor ontwikkeling)
        User::factory()->admin()->create([
            'email' => 'admin@juniordev.nl',
        ]);

        // Studenten met profielen
        $students = User::factory(10)->student()->create();
        $students->each(fn($student) =>
            StudentProfile::factory()->create(['user_id' => $student->id])
        );

        // Bedrijven met profielen, opdrachten en reacties
        User::factory(5)->company()->create()->each(function ($company) use ($students) {
            CompanyProfile::factory()->create(['user_id' => $company->id]);

            Assignment::factory(fake()->numberBetween(2, 5))->create(['user_id' => $company->id])
                ->each(function ($assignment) use ($students) {
                    $students->random(fake()->numberBetween(1, 5))->each(fn($student) =>
                        Application::factory()->create([
                            'assignment_id' => $assignment->id,
                            'user_id' => $student->id,
                        ])
                    );
                });
        });
    }
}
