<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Product;
use App\Models\ProductImage;

class ProductImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all products
        $products = Product::all();

        foreach ($products as $product) {
            // Create 1-4 images for each product
            $imagesCount = rand(1, 4);
            
            ProductImage::factory()
                ->count($imagesCount)
                ->create(['product_id' => $product->id]);
            
            // Ensure at least one primary image
            if (!$product->images()->where('is_primary', true)->exists()) {
                $product->images()->first()->update(['is_primary' => true]);
            }
        }
    }
}
