<?php
namespace Database\Factories;

use App\Models\Assignment;
use Illuminate\Database\Eloquent\Factories\Factory;

class AssignmentFactory extends Factory
{
    protected $model = Assignment::class;

    public function definition(): array {
        $titles = [
            'Junior PHP Developer gezocht',
            'Frontend Developer Stage',
            'Laravel Developer Bijbaan',
            'React Developer Opdracht',
            'Fullstack Developer Freelance',
            'Junior Developer voor startup',
            'Web Developer Internship',
            'Junior Backend Developer',
        ];
        return [
            'title' => $this->faker->randomElement($titles),
            'description' => $this->faker->paragraphs(3, true),
            'type' => $this->faker->randomElement(['stage', 'bijbaan', 'freelance', 'fulltime', 'parttime']),
            'region' => $this->faker->randomElement(['Amsterdam', 'Rotterdam', 'Utrecht', 'Den Haag', 'Eindhoven', 'Groningen', 'Tilburg', 'Remote']),
            'requirements' => $this->faker->paragraph(2),
            'status' => $this->faker->randomElement(['open', 'open', 'open', 'closed']),
        ];
    }
}
