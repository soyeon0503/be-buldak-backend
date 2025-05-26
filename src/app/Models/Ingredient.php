<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory, Notifiable;

    //재료
    protected $fillable = [
        'title',
        'description',
    ];

}
