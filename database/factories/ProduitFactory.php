<?php

namespace Database\Factories;

use App\Models\CategorieProduit;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produit>
 */
class ProduitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nom'=>$this->faker->streetName(),
            'quantite'=>$this->faker->randomNumber(7),
            'description'=>$this->faker->realText(10),
            'prix'=>$this->faker->randomFloat(2,1,9000),
            'categorie_produit_id'=>CategorieProduit::pluck("id")->random(),
        ];
    }
}
