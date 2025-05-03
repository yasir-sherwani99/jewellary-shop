<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = array(
            array(
                'name' => 'Rings',
                'slug' => 'rings',
                'icon' => null,
                'picture' => null,
                'is_active' => 1
            ),
            array(
                'name' => 'Necklaces',
                'slug' => 'necklaces',
                'icon' => null,
                'picture' => null,
                'is_active' => 1
            ),
            array(
                'name' => 'Bracelets',
                'slug' => 'bracelets',
                'icon' => null,
                'picture' => null,
                'is_active' => 1
            ),
            array(
                'name' => 'Earrings',
                'slug' => 'earrings',
                'icon' => null,
                'picture' => null,
                'is_active' => 1
            ),
            array(
                'name' => 'Anklets',
                'slug' => 'anklets',
                'icon' => null,
                'picture' => null,
                'is_active' => 1
            ),
            array(
                'name' => 'Brooches & Pins',
                'slug' => 'brooches-&-pins',
                'icon' => null,
                'picture' => null,
                'is_active' => 1
            ),
            array(
                'name' => 'Bangles',
                'slug' => 'bangles',
                'icon' => null,
                'picture' => null,
                'is_active' => 1
            ),
            array(
                'name' => 'Bags',
                'slug' => 'bags',
                'icon' => null,
                'picture' => null,
                'is_active' => 1
            ),
        );

        if(count($categories) > 0) {
            foreach($categories as $key => $value) {
                Category::updateOrCreate([
                    'name' => $value['name']
                ],[
                    'slug' => $value['slug'],
                    'icon' => $value['icon'],
                    'picture' => $value['picture'], 
                    'is_active' => $value['is_active']
                ]);
            }
        }
    }
}
