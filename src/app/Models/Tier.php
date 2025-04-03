<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Tier extends Model
{
     use HasFactory, Notifiable;

     protected $fillable = [
         'id',
         'name',
         'description',
         'image_path',
     ];

     public function tier()
     {
         return $this->hasMany(Tier::class);
     }

}
