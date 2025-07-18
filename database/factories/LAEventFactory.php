<?php

namespace Database\Factories;

use App\Models\LAEvent;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LAEventFactory extends Factory {
    protected $model = LAEvent::class;

    public function definition(): array {
        return [
            'user_id' => User::factory(),
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'date' => $this->faker->dateTimeBetween('now', '+1 month'),
            'location' => $this->faker->city,
            'status' => 'approved',
        ];
    }
}
