<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(2,  true),
            'description' => $this->faker->text(100),
            'slug' => Str::slug($this->faker->sentence(2,  true)),
            'price' => rand(20,500),
            'stock' => rand(0,200),
            'user_id' => rand(1,3),
            'category_id' => rand(1,10),
            'sub_category_id' => rand(1,50)
        ];
    }
}
