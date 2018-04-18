<?php

use Illuminate\Database\Seeder;
use App\Model;

class ModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::insert([
            [
                'brand_id' => '1',
                'name' => 'S-class'
            ],
            [
                'brand_id' => '1',
                'name' => 'C-class'
            ],
            [
                'brand_id' => '2',
                'name' => 'M-3'
            ],
            [
                'brand_id' => '2',
                'name' => 'M-5'
            ],
            [
                'brand_id' => '4',
                'name' => 'Large'
            ],
            [
                'brand_id' => '3',
                'name' => 'Transit'
            ],
        ]);
    }
}
