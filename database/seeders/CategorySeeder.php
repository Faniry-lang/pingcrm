<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $names = ['Technology', 'Science', 'Design', 'Marketing', 'Business'];
        foreach ($names as $name) {
            Category::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'description' => $name . ' related items',
                'is_active' => true,
            ]);
        }

        Category::factory()->count(15)->create();
    }
}
