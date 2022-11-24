<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriePost extends Model
{
    use HasFactory;

    function posts(){
        return $this->hasMany(Post::class,'categorie_post_id');
    }
}
