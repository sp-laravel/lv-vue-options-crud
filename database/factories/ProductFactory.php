<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory {
  protected $model = Product::class;

  public function definition(): array {
    return [
      'name' => $this->faker->word,
      'description' => $this->faker->sentence,
      'price' => $this->faker->randomFloat(2, 10, 100),
      'stock' => $this->faker->numberBetween(0, 100),
      'image' => 'placeholder.jpg', // Cambia esto por la lógica para las imágenes
    ];
  }
}