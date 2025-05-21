<?php

namespace Database\Seeders;

use App\Models\ShippingMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShippingMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $methods = array(
            array(
                'name' => 'Free Shipping',
                'description' => 'The cost of delivering an item is included in the item\'s price, so the customer doesn\'t pay any extra shipping fees.',
                'price' => 0,
                'active' => 1
            ),
            array(
                'name' => 'Standard Shipping',
                'description' => 'Standard shipping is also known as economy or regular shipping. It\'s the cheapest shipping service available from the courier.',
                'price' => 250,
                'active' => 0
            ),
            array(
                'name' => 'Express Shipping',
                'description' => 'Express shipping is a fast delivery option that ensures quick arrival of packages. It usually deliver items within 1 to 3 business days.',
                'price' => 500,
                'active' => 0
            ),
        );

        if(count($methods) > 0) {
            foreach($methods as $key => $value) {
                ShippingMethod::updateOrCreate([
                    'name' => $value['name']
                ],[
                    'description' => $value['description'],
                    'price' => $value['price'],
                    'active' => $value['active']
                ]);
            }
        }
    }
}
