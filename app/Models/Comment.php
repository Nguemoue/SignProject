<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id','post_id','contenu'
    ];
    function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    protected $casts = [
        'created_at'=>"datetime:Y-m-d",
        'updated_at'=>"datetime:Y-m-d"
    ];
}
