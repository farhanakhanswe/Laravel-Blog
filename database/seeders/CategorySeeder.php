<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get('database/data/categories.json');
        $categories = collect(json_decode($json, true)); // 2nd argument if true this method converts into associative array

        $categories->each(function($category){
            Category::firstOrCreate([
                'name' => $category['name'],
                'description' => $category['description'],
                'slug' => $category['slug']
            ]);
        });
    }
}
