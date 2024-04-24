<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\{Album, AlbumCategory, Category, Photo, User};
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        User::truncate();
        AlbumCategory::truncate();
        Category::truncate();
        Album::truncate();
        Photo::truncate();

        User::factory(50)->has(
            Album::factory(20)
        )->create();
        $this->call(CategorySeeder::class);
        $this->call(AlbumCategorySeeder::class);
    }
}
