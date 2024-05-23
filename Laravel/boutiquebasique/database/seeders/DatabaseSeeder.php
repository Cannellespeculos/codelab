<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Basket;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $products = Product::factory()->count(10)->create();

        $ids = range(1, 10);
        User::factory()->count(10)->create()->each(function ($user) use($products) {
            $products->each(function ($product) use($user) {
                $addOrNot = rand(0,1);
                if ($addOrNot) {
                    Basket::factory()->create(["product_id" => $product->id, 'user_id' => $user->id]);
                };
            });
        });

    }
}
