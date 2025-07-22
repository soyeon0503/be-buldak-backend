<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'email',
        'password',
        'name',
        'tier_id',
        'birth',
        'provider',
    ];

    protected $casts = [
        'birth'             => 'date',
        'tier_id'           => 'integer',
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
    ];

    protected static function booted(): void
    {
        static::creating(function ($user) {
            if (is_null($user->tier_id)) {
                $user->tier_id = 1;
            }
        });
    }

    public function tier()
    {
        return $this->belongsTo(Tier::class, 'tier_id');
    }

    public function eatenReceipt()
    {
        return $this->belongsToMany(Receipt::class, 'user_eaten_receipts')
                    ->withTimestamps();
    }

    public function savedReceipt()
    {
        return $this->belongsToMany(Receipt::class, 'user_saved_receipts')
                    ->withTimestamps();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

}
