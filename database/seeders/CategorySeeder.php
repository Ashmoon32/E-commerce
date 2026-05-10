<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Electronics',
            'Fashion & Apparel',
            'Beauty & Skin Care',
            'Home & Living',
            'Appliances',
            'Sports & Outdoors',
            'Toys & Games',
            'Groceries',
            'Health & Wellness',
            'Jewelry & Watches',
            'Automotive',
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['name' => $category]
            );
        }
    }
}
