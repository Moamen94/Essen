<?php

namespace Database\Factories;

use App\Models\FoodItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<FoodItem>
 */
class FoodItemFactory extends Factory
{
    protected $model = FoodItem::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->words(3, true),
            'description' => $this->faker->sentence(10),
            'price' => $this->faker->randomFloat(2, 5, 40),
            'rating' => $this->faker->numberBetween(3, 5),
        ];
    }
}
