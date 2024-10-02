<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Psy\Util\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Truck>
 */
class TruckFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startYear = 1900;
        $endYear = date('Y') + 5;

        return [
            'year' => rand($startYear, $endYear),
            'name' => strtoupper(fake()->regexify('[A-Za-z0-9]{8}')),
            'notes' => fake()->sentence()
        ];
    }
}
