<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [

    ];

    protected $casts = [

    ];

    function tags(){
        return $this->hasMany(Tag::class);
    }
    function comments(){
        return $this->hasMany(Comment::class);
   }
    function resource(){
        return $this->hasOne(RessourcePost::class,'produit_id');
    }
    function categorie(){
        return $this->belongsTo(CategoriePost::class,'categorie_post_id');
    }
}
