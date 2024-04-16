<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Album;
use App\Models\Photo;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        //$this->call(UserSeeder::class);
        //$this->call(AlbumSeeder::class);
        //$this->call(PhotoSeeder::class);
        User::factory(20)->has(
            Album::factory(10)->has(
                Photo::factory(20)
            )
        )->create();
    }
}
