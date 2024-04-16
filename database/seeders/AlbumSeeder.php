<?php

namespace Database\Seeders;

use App\Models\Album;
use Database\Factories\AlbumFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AlbumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Album::factory(30)->create();
    }
}
