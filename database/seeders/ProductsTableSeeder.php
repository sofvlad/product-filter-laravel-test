<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();

        Product::factory()
            ->count(100)
            ->create([
                'category_id' => function () use ($categories) {
                    return $categories->random()->id;
                },
            ]);
    }
}
