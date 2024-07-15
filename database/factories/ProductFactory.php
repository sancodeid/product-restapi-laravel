<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'image' => $this->faker->imageUrl(),
            'title' => $this->faker->name(),
            'price' => $this->faker->numberBetween(1000, 10000),
            'feature' => $this->faker->word(),
        ];
    }
}
