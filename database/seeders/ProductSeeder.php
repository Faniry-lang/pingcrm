<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        if (Category::count() === 0) {
            Category::factory()->count(5)->create();
        }

        Product::factory()->count(30)->create();
    }
}
