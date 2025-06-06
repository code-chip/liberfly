<?php

/**
 * @copyright  Copyright (c) 2025 Code Chip (https://codechip.com.br)
 * @author     Will <willvix@outlook.com>
 * @Link       https://github.com/code-chip
 */

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'corporateName' => $this->faker->company,
            'tradeName' => $this->faker->companySuffix,
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'openingDate' => $this->faker->optional()->date(),
            'registrationStatus' => $this->faker->randomElement(['active', 'inactive', 'pending']),
        ];
    }    
}
