<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class User extends Authenticatable implements MustVerifyEmailContract
{
    use HasFactory, Notifiable, HasApiTokens, MustVerifyEmailTrait;

    // Specify the primary key
    protected $primaryKey = 'user_id';

    // Indicate that the primary key is auto-incrementing
    public $incrementing = true;

    // Set the key type to int
    protected $keyType = 'int';

    // Field casts
    protected $casts = [
        'email_verified' => 'boolean',
        'active' => 'boolean',
        'preferences' => 'json',
    ];

    protected $fillable = [
        'name',
        'password',
        'email',
        'image',
        'phone',
        'address',
        'city',
        'state',
        'zip_code',
        'bio',
        'website',
        'facebook',
        'twitter',
        'instagram',
        'linkedin',
        'youtube',
        'email_verified',
        'email_verification_token',
        'preferences',
        'role',
        'active',
    ];
    
    

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Define relationship with properties
    public function properties()
    {
        return $this->hasMany(Property::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            if (empty($user->email_verification_token)) {
                $user->email_verification_token = Str::random(60);
            }
        });
    }
}
