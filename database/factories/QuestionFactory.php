<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title'=>rtrim($this->faker->sentence(rand(5,10)),"0"),
            'body'=>$this->faker->paragraph(rand(3,7),true),
            'views'=>rand(0,10),
            //'answers_count'=>rand(0,10),
            'votes'=>rand(-3,10),
        ];
    }
}
