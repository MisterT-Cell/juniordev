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
        // Admin
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@juniordev.nl',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // Students
        $students = User::factory(10)->create(['role' => 'student']);
        foreach ($students as $student) {
            StudentProfile::factory()->create(['user_id' => $student->id]);
        }

        // Companies
        $companies = User::factory(5)->create(['role' => 'company']);
        foreach ($companies as $company) {
            CompanyProfile::factory()->create(['user_id' => $company->id]);
            $assignments = Assignment::factory(3)->create(['user_id' => $company->id]);

            // Applications from students
            foreach ($assignments as $assignment) {
                $randomStudents = $students->random(rand(1, 4));
                foreach ($randomStudents as $student) {
                    Application::factory()->create([
                        'assignment_id' => $assignment->id,
                        'user_id' => $student->id,
                    ]);
                }
            }
        }

        // Test student account
        $testStudent = User::factory()->create([
            'name' => 'Test Student',
            'email' => 'student@juniordev.nl',
            'password' => bcrypt('password'),
            'role' => 'student',
        ]);
        StudentProfile::factory()->create(['user_id' => $testStudent->id]);

        // Test company account
        $testCompany = User::factory()->create([
            'name' => 'Test Bedrijf',
            'email' => 'company@juniordev.nl',
            'password' => bcrypt('password'),
            'role' => 'company',
        ]);
        CompanyProfile::factory()->create(['user_id' => $testCompany->id]);
        Assignment::factory(3)->create(['user_id' => $testCompany->id]);
    }
}
