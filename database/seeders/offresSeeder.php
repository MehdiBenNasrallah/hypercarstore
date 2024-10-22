<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Models\offres;
use App\Models\User;
use App\Models\voitures;

class offresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        $users = User::all()->pluck('id')->toArray();
        $voitures = voitures::all()->pluck('id')->toArray();
        
        for ($i=0; $i < 17; $i++) { 
            offres::create([
                'prix' => $faker->randomFloat(2, 10000, 100000),
                'message' => $faker->text,
                'voiture_id' => $faker->randomElement($voitures),
                'user_id' => $faker->randomElement($users),
            ]);
        }
        
        
    }
}
