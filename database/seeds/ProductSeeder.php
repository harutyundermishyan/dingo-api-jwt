<?php

use App\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::insert([
            [
                'model_id' => '1',
                'image' => '1.jpg',
                'year' => '2002',
                'price' => '6000',
                'rudder' => 'right',
                'transmission_box' => 'automatic',
                'engine' => 'Disel',
                'condition' => 'good',
                'state' => 'Armenia',
            ],
            [
                'model_id' => '2',
                'image' => '1.jpg',
                'year' => '2005',
                'price' => '8000',
                'rudder' => 'right',
                'transmission_box' => 'automatic',
                'engine' => 'Benzine',
                'condition' => 'normal',
                'state' => 'Russia',
            ],
            [
                'model_id' => '3',
                'image' => '1.jpg',
                'year' => '2002',
                'price' => '5000',
                'rudder' => 'right',
                'transmission_box' => 'automatic',
                'engine' => 'Disel',
                'condition' => 'good',
                'state' => 'Armenia',
            ],
        ]);
    }
}
