<?php

use App\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       Brand::insert([
            [
                'category_id' => '1',
                'name' => 'Mercedes'
            ],
            [
                'category_id' => '1',
                'name' => 'BMW'
            ],
            [
                'category_id' => '2',
                'name' => 'Trek'
            ],
            [
                'category_id' => '3',
                'name' => 'Mercedes'
            ],
            [
                'category_id' => '3',
                'name' => 'Ford'
            ],
        ]);
    }
}
