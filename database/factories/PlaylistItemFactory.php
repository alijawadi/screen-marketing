<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PlaylistItemFactory extends Factory
{

    public function definition()
    {
        return [
            'item_type' => fake()->city(),
            'repeat_type' => array_rand(['daily', 'weekly', 'monthly', 'yearly', 'custom']),
            'duration' => fake()->numerify("####"),
        ];
    }
}
