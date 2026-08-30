<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Membuat akun Admin Default
        User::create([
            'name' => 'Grand Illusionist',
            'email' => 'admin@oneemagic.com',
            'password' => Hash::make('magic123'),
            'role' => 'admin'
        ]);

        // Membuat akun User Biasa
        User::create([
            'name' => 'Magic Enthusiast',
            'email' => 'user@oneemagic.com',
            'password' => Hash::make('magic123'),
            'role' => 'customer'
        ]);
        // Seed Categories
        $cat1 = \App\Models\Category::create(['name' => 'Card Magic', 'slug' => 'card-magic']);
        $cat2 = \App\Models\Category::create(['name' => 'Mentalism', 'slug' => 'mentalism']);
        $cat3 = \App\Models\Category::create(['name' => 'Illusion', 'slug' => 'illusion']);

        // Seed Portfolios
        \App\Models\Portfolio::create([
            'category_id' => $cat1->id,
            'title' => 'Gala Dinner Illusion',
            'client_name' => 'Tech Corp',
            'description' => 'A mind-bending card magic performance for 500 tech executives.',
            'image_path' => 'demo-card.jpg',
            'event_year' => '2025'
        ]);

        \App\Models\Portfolio::create([
            'category_id' => $cat2->id,
            'title' => 'CEO Mind Reading',
            'client_name' => 'Finance Inc',
            'description' => 'Revealed the hidden thoughts of the CEO in a private gathering.',
            'image_path' => 'demo-mentalism.jpg',
            'event_year' => '2024'
        ]);

        // Seed Journals
        \App\Models\Journal::create([
            'title' => 'Filosofi Di Balik Kartu',
            'slug' => 'filosofi-di-balik-kartu',
            'content' => 'Setiap kartu memiliki makna. Sekop berarti...',
            'image_path' => 'journal-1.jpg',
            'published_date' => now()
        ]);
    }
}
