<?php

namespace Database\Factories;

use App\Models\Produit;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CouleurProduit>
 */
class CouleurProduitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nom'=>$this->faker->colorName(),
            'code'=>$this->faker->colorName(),
            'produit_id'=>Produit::pluck('id')->random()
        ];
    }
}
