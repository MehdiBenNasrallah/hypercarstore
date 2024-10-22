<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Models\voitures;
use App\Models\User;

class voituresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $faker->addProvider(new \Faker\Provider\FakeCar($faker));
        
        for ($i=0; $i < 10; $i++) { 
            voitures::create([
                'marque' => $faker->vehicleBrand,
                'modele' => $faker->vehicleModel,
                'annee' => $faker->year,
                'valeur' => $faker->randomFloat(2, 10000, 100000),
                'description' => $faker->text,
            ]);
        }
        
    }
}
