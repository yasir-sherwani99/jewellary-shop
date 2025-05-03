<?php

namespace Database\Factories;

use App\Models\ProductImage;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductImage>
 */
class ProductImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductImage::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    
    public function definition(): array
    {
        // $jewelryTypes = [
        //     'ring' => 'gold+ring',
        //     'necklace' => 'diamond+necklace',
        //     'earrings' => 'pearl+earrings',
        //     'bracelet' => 'silver+bracelet',
        //     'watch' => 'luxury+watch'
        // ];
        
        // $type = $this->faker->randomElement(array_values($jewelryTypes));
        // $flickrUrl = "https://loremflickr.com/800/800/{$type}/all";
        // Get all images from the public/product_images directory
        $imageDirectory = public_path('assets/images/demos/demo-25/product_images');
        $imageFiles = File::files($imageDirectory);
        
        // Select a random image or use a default
        $imageName = count($imageFiles) > 0 
            ? $this->faker->randomElement($imageFiles)->getFilename()
            : 'default.jpg';

        return [
            'product_id' => \App\Models\Product::factory(),
            'image_url' => 'assets/images/demos/demo-25/product_images/' . $imageName,
            'is_primary' => $this->faker->boolean(20), // 20% chance to be primary
            'display_order' => $this->faker->numberBetween(1, 5),
        ];
    }
}
