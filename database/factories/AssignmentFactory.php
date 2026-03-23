<?php

namespace Database\Factories;

use App\Models\Assignment;
use Illuminate\Database\Eloquent\Factories\Factory;

class AssignmentFactory extends Factory
{
    protected $model = Assignment::class;

    public function definition(): array
    {
        $types = ['stage', 'bijbaan', 'freelance', 'parttime', 'fulltime'];
        $type = fake()->randomElement($types);

        $techTerms = ['PHP', 'Laravel', 'JavaScript', 'React', 'Vue.js', 'Node.js',
            'Python', 'Fullstack', 'Frontend', 'Backend', 'Mobile', 'API'];

        $roles = ['Developer', 'Engineer', 'Programmeur', 'Stagiair'];

        $title = fake()->randomElement($techTerms) . ' ' . fake()->randomElement($roles)
            . ' (' . ucfirst($type) . ')';

        return [
            'title' => $title,
            'description' => fake()->paragraphs(fake()->numberBetween(2, 5), true),
            'type' => $type,
            'region' => fake()->boolean(20) ? 'Remote' : fake()->city(),
            'requirements' => fake()->paragraph(fake()->numberBetween(1, 3)),
            'status' => fake()->randomElement(['open', 'open', 'open', 'closed']),
        ];
    }
}
