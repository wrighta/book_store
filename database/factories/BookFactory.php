<?php

namespace Database\Factories;

use App\Models\Publisher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->word,
            'category' => $this->faker->text(50),
            'description' => $this->faker->text(200),
            'author' => $this->faker->name,
            'likes' => $this->faker->numberBetween(0, 1000000),
            //  'publisher_id' => Publisher::factory()
        ];
    }
}
