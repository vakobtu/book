<?php

namespace Database\Factories;
use App\Book;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

class BooksFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'slug' => $this->faker->sentence(),
            'name' => $this->faker->name(),
            'year' => $this->faker->numberBetween(1700,2022),
            'status' => $this->faker->randomElement(['1', '0']),
        ];
    }
}

