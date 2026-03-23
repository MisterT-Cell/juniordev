<?php
namespace Database\Factories;

use App\Models\CompanyProfile;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyProfileFactory extends Factory
{
    protected $model = CompanyProfile::class;

    public function definition(): array {
        return [
            'company_name' => $this->faker->company(),
            'description' => $this->faker->paragraph(4),
            'website' => $this->faker->url(),
            'region' => $this->faker->randomElement(['Amsterdam', 'Rotterdam', 'Utrecht', 'Den Haag', 'Eindhoven', 'Groningen', 'Tilburg']),
            'phone' => $this->faker->phoneNumber(),
        ];
    }
}
