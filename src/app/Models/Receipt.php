<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
     use HasFactory, Notifiable;

     protected $fillable = [
        'title',
        'image_path',
        'description',
        'ingredients',
        'steps',
        'servings',
        'cooking_time',
        'spicy',
        'saved',
        'views',
        'rate',
        'recommend_side_menus',
        'writer',
    ];

     protected $casts = [
        'ingredients' => 'array',
        'steps' => 'array',
        'recommend_side_menus' => 'array',
    ];
}
