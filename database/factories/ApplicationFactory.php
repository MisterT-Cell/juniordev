<?php
namespace Database\Factories;

use App\Models\Application;
use Illuminate\Database\Eloquent\Factories\Factory;

class ApplicationFactory extends Factory
{
    protected $model = Application::class;

    public function definition(): array {
        return [
            'motivation' => $this->faker->paragraphs(2, true),
            'status' => $this->faker->randomElement(['pending', 'pending', 'accepted', 'rejected']),
        ];
    }
}
