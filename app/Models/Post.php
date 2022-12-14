<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        "titre","sousTitre","contenu","administrateur_id","image","categorie_post_id"
    ];

    protected $casts = [

    ];

    function tags(){
        return $this->belongsToMany(Tag::class,'post_tags');
    }
    function comments(){
        return $this->hasMany(Comment::class);
   }
    function resource(){
        return $this->hasOne(RessourcePost::class,'post_id');
    }
    function categorie(){
        return $this->belongsTo(CategoriePost::class,'categorie_post_id')->withDefault([
            'nom'=>'',
            'description'=>''
        ]);
    }
}
