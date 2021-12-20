<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->sentence(2);

        return [
            'name'        => $name,
            'slug'        => Str::slug($name),
            'description' => $this->faker->text(),
            'created_at'  => $this->faker->dateTimeBetween('-1 week', '+4 days')
        ];
    }
}
