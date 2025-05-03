<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $metalType = ['gold', 'silver', 'platinum', 'rose_gold', 'white_gold', 'other'];

        return [
            'name' => $this->faker->name,
            'slug' => Str::slug($this->faker->name),
            'category_id' => $this->faker->numberBetween(1, 8),
            'description' => $this->faker->paragraph,
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'discount_price' => $this->faker->randomFloat(2, 10, 1000),
            'metal_type' => $this->faker->randomElement($metalType),
            'weight_grams' => null,
            'is_customizable' => 0,
            'stock_quantity' => $this->faker->numberBetween(1000, 9999),
            'is_active' => 1
        ];
    }
}
