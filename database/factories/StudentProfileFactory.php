<?php
namespace Database\Factories;

use App\Models\StudentProfile;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentProfileFactory extends Factory
{
    protected $model = StudentProfile::class;

    public function definition(): array {
        return [
            'phone' => $this->faker->phoneNumber(),
            'bio' => $this->faker->paragraph(3),
            'skills' => implode(', ', $this->faker->randomElements(['PHP', 'Laravel', 'JavaScript', 'Vue.js', 'React', 'MySQL', 'CSS', 'HTML', 'Python', 'Git'], 3)),
            'region' => $this->faker->randomElement(['Amsterdam', 'Rotterdam', 'Utrecht', 'Den Haag', 'Eindhoven', 'Groningen', 'Tilburg']),
            'education' => $this->faker->randomElement(['HBO Informatica', 'HBO Software Engineering', 'MBO ICT', 'WO Informatica', 'HBO Mediadesign']),
        ];
    }
}
