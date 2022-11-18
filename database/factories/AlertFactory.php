<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Alert>
 */
class AlertFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'project_id' => 1,
            'first_send' =>  $this->faker->date(),
            'last_sent' =>  $this->faker->date(),
            'times_sent' =>  0,
            'first_send_time' => $this->faker->date(),
            'last_send_time' => $this->faker->date()
        ];
    }
}
