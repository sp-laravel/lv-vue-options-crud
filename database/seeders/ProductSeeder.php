<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder {
  /**
   * Run the database seeds.
   */
  public function run(): void {
    $products = [
      [
        'name' => 'Producto 1',
        'description' => 'Descripción del producto 1',
        'price' => 19.99,
        'stock' => 50,
        'image' => 'image1.jpg',
      ],
      [
        'name' => 'Producto 2',
        'description' => 'Descripción del producto 2',
        'price' => 29.99,
        'stock' => 30,
        'image' => 'image2.jpg',
      ],
      // Agrega más productos aquí
    ];

    foreach ($products as $product) {
      DB::table('products')->insert($product);
    }
  }
}