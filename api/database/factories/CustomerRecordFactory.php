<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CustomerRecord>
 */
class CustomerRecordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'address' => $this->faker->address,
            'contact_information' => $this->faker->phoneNumber,
            'email' => $this->faker->email,
            'age' => $this->faker->numberBetween(18, 100),
            'nic_number' => $this->faker->regexify('[0-9]{5}-[0-9]{7}-[0-9]{1}'),
            'gender' => $this->faker->randomElement(['Male', 'Female', 'Other']),
        ];
    }
}
