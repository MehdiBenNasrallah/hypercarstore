<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        $user = new User;
        $user->name = 'admin';
        $user->email = 'admin@mail.com';
        $user->password = Hash::make('12345678');
        $user->role =  User::admin_role;
         $user->save();
        
        for ($i=0; $i < 10; $i++) { 
            $user = new User();
            $user->name = $faker->name;
            $user->email = $faker->unique()->email;
            $user->password = bcrypt('password');
            $user->role =  User::user_role;
            $user->save();
        }
    }
}
