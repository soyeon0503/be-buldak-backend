<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, HasFactory;
   
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'email',
        'name',
        'password',
        'tier_id',
        'birth',
        'provider',
        'provider_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'birth' => 'date',
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get the tier that the user belongs to.
     */
    public function tier()
    {
        return $this->belongsTo(Tier::class);
    }

    public function eatenReceipt()
    {
        return $this->belongsToMany(Receipt::class, 'user_eaten_receipts')->withTimestamps();
    }

    public function savedReceipt()
    {
        return $this->belongsToMany(Receipt::class, 'user_saved_receipts')->withTimestamps();
    }
}
