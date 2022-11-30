<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecificationProduit extends Model
{
    use HasFactory;
    protected $fillable = [
        'weight','peremtion','height','depth','consigne','width'
    ];

    protected $casts = [
        'peremtion'=>'date'
    ];
}
