<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Tag;
use App\Models\User;
use App\Models\Article;
use Illuminate\Database\Seeder;
use Database\Factories\TagFactory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void // run: php artisan db:seed
    {
        $this->call(CategorySeeder::class); 
        User::factory()->count(10)->create();
        Article::factory()
                ->has(Tag::factory()->count(2))
                ->count(50)
                ->create();
    }
}
