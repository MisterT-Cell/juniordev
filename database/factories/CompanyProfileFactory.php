<?php

namespace Database\Factories;

use App\Models\CompanyProfile;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyProfileFactory extends Factory
{
    protected $model = CompanyProfile::class;

    public function definition(): array
    {
        return [
            'company_name' => fake()->company(),
            'description' => fake()->paragraph(fake()->numberBetween(3, 6)),
            'website' => fake()->url(),
            'region' => fake()->city(),
            'phone' => fake()->phoneNumber(),
        ];
    }
}
