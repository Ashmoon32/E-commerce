<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run()
    {
        $electronics = Category::create(['name' => 'Electronics']);
        $books = Category::create(['name' => 'Books']);
        $clothing = Category::create(['name' => 'Clothing']);


        Product::create([
            'name' => 'Smartphone X',
            'description' => 'A high-end smartphone with advanced features.',
            'price' => 999.99,
            'stock' => 10,
            'category_id' => $electronics->id,
        ]);

        Product::create([
            'name' => 'Laptop Pro',
            'description' => 'Powerful laptop for work.',
            'price' => 1299.99,
            'stock' => 5,
            'category_id' => $electronics->id,
        ]);

        Product::create([
            'name' => 'Learn Laravel Book',
            'description' => 'From zero to hero.',
            'price' => 29.99,
            'stock' => 20,
            'category_id' => $books->id,
        ]);
    }
}
