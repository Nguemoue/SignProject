<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LikeProduit extends Model
{
    use HasFactory;

    protected $fillable = [
        'produit_id',
        'user_id'
    ];
}
