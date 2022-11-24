<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(20)->create();
        \App\Models\CategorieProduit::factory(40)->create();
        \App\Models\Produit::factory(30)->create()->each(function($data){
            \App\Models\CouleurProduit::factory()->create([
                'nom'=>fake()->unique()->colorName(),
               'produit_id'=>$data->id,
               'code'=>fake()->colorName() 
            ]);
            \App\Models\MarqueProduit::factory()->create([
                'produit_id' => $data->id,
                'nom'=>fake()->unique()->company()
            ]);
            \App\Models\PhotoProduit::factory()->create([
                'produit_id' => $data->id,
                'photo'=>fake()->imageUrl()

            ]);
        });
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
