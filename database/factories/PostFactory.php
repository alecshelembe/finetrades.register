<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence,         // Generates a fake title
            'body' => $this->faker->paragraph,        // Generates a fake paragraph for the body
            'status' => 'active',                     // Default status is 'active'
            // Add other fields if necessary
        ];
    }
}
