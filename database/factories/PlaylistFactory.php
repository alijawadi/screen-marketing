<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JetBrains\PhpStorm\ArrayShape;

class PlaylistFactory extends Factory
{

    #[ArrayShape(['name' => "string", 'duration' => "string"])] public function definition(): array
    {
        return [
            'name' => fake()->streetName(),
            'duration' => fake()->numerify("####"),
        ];
    }
}
