<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ClockIn>
 */
class ClockInFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $time = date('Y-m-d H:i:s', time());
        return [
            'timestamp' => $time,
            'latitude' => 40.12345678,
            'longitude' => 40.12345678,
        ];
    }
}
