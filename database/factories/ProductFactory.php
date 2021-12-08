<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->sentence(3);

        return [
            'name'        => $name,
            'code'        => Str::slug($name),
            'description' => $this->faker->text(),
            'price'       => $this->faker->randomFloat(1, 300, 3000) . '0',
            'category_id' => rand(1, 3),
            'created_at'  => $this->faker->dateTimeBetween('-1 week', '+4 days')
        ];
    }
}
