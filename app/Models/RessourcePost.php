<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RessourcePost extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'contenu',
        'post_id'
    ];
}
