<?php

namespace Database\Factories;

use App\Models\Product;
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
    protected $model = Product::class;

    public function definition()
    {
        $name = Str::title($this->faker->unique()->words($nb=2, $asText=true));
        $slug = Str::slug($name);
        $regular_price = $this->faker->numberBetween(10,500);
        $sale_price = $regular_price + 20;
        $category_id = \App\Models\Category::pluck('id');
        return [
            'name' => $name,
            'slug' => $slug,
            'short-description' => $this->faker->text(200),
            'description' => $this->faker->text(500),
            'regular_price' => $regular_price,
            'sale_price' => $sale_price,
            'SKU' => 'DIGI'.$this->faker->unique()->numberBetween(10,500),
            'stock-status' => $this->faker->randomElement($array = ['instock', 'outofstock']),
            'featured' => $this->faker->randomElement($array = [0, 1]),
            'quantity' => $this->faker->numberBetween(10,200),
            'image' => 'digital_'.$this->faker->numberBetween(1,22).'.jpg',
            'category_id' => $this->faker->randomElement($array = $category_id)
        ];
    }
}
