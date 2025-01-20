<?php

namespace Database\Seeders;

use App\Models\Document;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => config('app.email'),
            'password' => bcrypt(config('app.password')),
        ]);

        Product::factory(10)->create();
        ProductImage::factory(1)->create();
        Document::factory(10)->create();
    }
}
