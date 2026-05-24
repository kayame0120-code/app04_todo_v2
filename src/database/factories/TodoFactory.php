<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class TodoFactory extends Factory
{
    public function definition()
    {
        return [
            'category_id' => Category::inRandomOrder()->first()->id,
            'content' => $this->faker->realText(20),
        ];
    }
}
