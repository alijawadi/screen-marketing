<?php

namespace Database\Factories;

class Organization extends \Illuminate\Database\Eloquent\Factories\Factory
{

    /**
     * @inheritDoc
     */
    public function definition()
    {
        return [
            "name" => fake()->company,
            "description" => fake()->text(),
            "phone" => fake()->phoneNumber(),//nullable
            "country_code" => fake()->countryCode(),//nullable
            "country" => fake()->country(),//nullable
            "city" => fake()->city,//nullable
            "street" => fake()->streetName,//nullable
            "postcode" => fake()->postcode,//nullable
            "lat" => fake()->latitude,//nullable
            "lon" => fake()->longitude,//nullable
        ];
    }
}
