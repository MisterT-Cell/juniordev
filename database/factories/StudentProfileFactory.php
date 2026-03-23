<?php

namespace Database\Factories;

use App\Models\StudentProfile;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentProfileFactory extends Factory
{
    protected $model = StudentProfile::class;

    public function definition(): array
    {
        $allSkills = ['PHP', 'Laravel', 'JavaScript', 'TypeScript', 'Vue.js', 'React', 'Node.js',
            'MySQL', 'PostgreSQL', 'CSS', 'HTML', 'Tailwind', 'Bootstrap', 'Python', 'Git',
            'Docker', 'REST API', 'Linux', 'Figma', 'Scrum'];

        $levels = ['HBO', 'MBO', 'WO'];
        $studies = ['Informatica', 'Software Engineering', 'ICT', 'Mediadesign', 'Applied AI',
            'Game Development', 'Cybersecurity', 'Data Science'];

        return [
            'phone' => fake()->phoneNumber(),
            'bio' => fake()->paragraph(fake()->numberBetween(2, 5)),
            'skills' => implode(', ', fake()->randomElements($allSkills, fake()->numberBetween(2, 6))),
            'region' => fake()->city(),
            'education' => fake()->randomElement($levels) . ' ' . fake()->randomElement($studies),
        ];
    }
}
