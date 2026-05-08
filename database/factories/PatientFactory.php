<?php

namespace Database\Factories;

use App\Models\BloodType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'blood_type_id' => BloodType::inRandomOrder()->first()->id ?? 1,
            'allergies' => fake()->randomElement(['Ninguna', 'Penicilina', 'Polvo']),
            'chronic_conditions' => fake()->randomElement(['Ninguna', 'Hipertensión', 'Diabetes']),
            'surgical_history' => fake()->randomElement(['Ninguna', 'Apendicectomía']),
            'family_history' => fake()->randomElement(['Ninguna', 'Padre diabético']),
            'emergency_contact_name' => fake()->name(),
            'emergency_contact_phone' => fake()->phoneNumber(),
            'emergency_contact_relationship' => fake()->randomElement(['Padre', 'Madre', 'Hermano']),
        ];
    }
}
