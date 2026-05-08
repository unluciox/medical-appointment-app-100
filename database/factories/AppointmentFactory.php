<?php

namespace Database\Factories;

use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'patient_id' => Patient::inRandomOrder()->first()->id ?? Patient::factory(),
            'doctor_id' => Doctor::inRandomOrder()->first()->id ?? Doctor::factory(),
            'date' => fake()->dateTimeBetween('now', '+1 month')->format('Y-m-d'),
            'start_time' => fake()->time('H:00'),
            'end_time' => fake()->time('H:30'),
            'duration' => 15,
            'reason' => fake()->sentence(),
            'status' => 1,
        ];
    }
}
