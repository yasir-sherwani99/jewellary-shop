<?php

namespace Database\Seeders;

use App\Models\TaxRate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaxRateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rates = array(
            array(
                'name' => 'Tax Rate',
                'rate' => '2.5',
                'country' => 'Pakistan',
                'active' => 1
            ),
        );

        if(count($rates) > 0) {
            foreach($rates as $key => $value) {
                TaxRate::updateOrCreate([
                    'country' => $value['country'],
                ],[
                    'name' => $value['name'],
                    'rate' => $value['rate'],
                    'active' => $value['active']
                ]);
            }
        }
    }
}
