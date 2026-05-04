<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'HP EliteBook 840 G8',
            'brand' => 'HP',
            'category' => 'Ordinateur',
            'description' => 'Intel i5, 8GB RAM, 512GB SSD, 14 pouces FHD, état excellent',
            'price' => 450000,
            'stock_quantity' => 5,
            'image' => null,
        ]);

        Product::create([
            'name' => 'Lenovo ThinkPad E15',
            'brand' => 'Lenovo',
            'category' => 'Ordinateur',
            'description' => 'Intel i7, 16GB RAM, 512GB SSD, 15 pouces FHD, état neuf',
            'price' => 550000,
            'stock_quantity' => 3,
            'image' => null,
        ]);

        Product::create([
            'name' => 'Dell Inspiron 15',
            'brand' => 'Dell',
            'category' => 'Ordinateur',
            'description' => 'Intel i5, 8GB RAM, 256GB SSD, 15 pouces FHD, état bon',
            'price' => 380000,
            'stock_quantity' => 2,
            'image' => null,
        ]);

        Product::create([
            'name' => 'iPhone 13 Pro',
            'brand' => 'Apple',
            'category' => 'Téléphone',
            'description' => '128GB, Or, état excellent, avec boîte et câble',
            'price' => 650000,
            'stock_quantity' => 2,
            'image' => null,
        ]);

        Product::create([
            'name' => 'Samsung Galaxy S21',
            'brand' => 'Samsung',
            'category' => 'Téléphone',
            'description' => '256GB, Noir, état neuf, avec accessoires',
            'price' => 480000,
            'stock_quantity' => 4,
            'image' => null,
        ]);

        Product::create([
            'name' => 'iPhone 12',
            'brand' => 'Apple',
            'category' => 'Téléphone',
            'description' => '64GB, Bleu, état bon, sans boîte',
            'price' => 420000,
            'stock_quantity' => 1,
            'image' => null,
        ]);

        Product::create([
            'name' => 'Samsung Galaxy A52',
            'brand' => 'Samsung',
            'category' => 'Téléphone',
            'description' => '128GB, Vert, état excellent',
            'price' => 280000,
            'stock_quantity' => 6,
            'image' => null,
        ]);

        Product::create([
            'name' => 'Redmi Note 11',
            'brand' => 'Xiaomi',
            'category' => 'Téléphone',
            'description' => '128GB, Gris, état neuf',
            'price' => 200000,
            'stock_quantity' => 8,
            'image' => null,
        ]);
    }
}
