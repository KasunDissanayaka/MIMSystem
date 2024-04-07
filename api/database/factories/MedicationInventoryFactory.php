<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MedicationInventory>
 */
class MedicationInventoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $medicationName = $this->faker->unique()->word;
        $medicationName .= ' ' . $this->faker->numberBetween(1, 1000) . 'Mg';

        return [
            'name' => $medicationName,
            'description' => $this->faker->paragraph,
            'quantity' => $this->faker->numberBetween(1, 100),
            'expiry_date' => $this->faker->dateTimeBetween('now', '+1 year')->format('Y-m-d'),
            'manufacturer' => $this->faker->company,
            'price' => 'Rs.'.$this->faker->randomFloat(2, 1, 1000),
        ];
    }
}
