<?php

namespace Database\Factories;

use App\Models\CategoriePost;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'titre'=>$this->faker->jobTitle(),
            'sousTitre'=>$this->faker->realText(10),
            'categorie_post_id'=>CategoriePost::pluck('id')->random(),
            'contenu'=>$this->faker->sentence()

        ];
    }
}
