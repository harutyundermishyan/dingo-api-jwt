<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       User::insert([
           [
            'name' => 'Harutyun',
            'email' => 'harutyun.dermishyan@gmail.com',
            'password' => bcrypt(123456)
           ],
           [
            'name' => 'Harutyun',
            'email' => 'harutyundermishyan@gmail.com',
            'password' => bcrypt(123456)
           ],
       ]);
    }
}
