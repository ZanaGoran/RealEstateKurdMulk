<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait; // Corrected import
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable implements MustVerifyEmailContract
{
    use HasFactory, Notifiable, HasApiTokens, MustVerifyEmailTrait;
    protected $casts = [
        'email_verified' => 'boolean',
        'active' => 'boolean',
        'preferences' => 'json',
    ];

    protected $fillable = [
        'username',
        'password',
        'email',
        'first_name',
        'last_name',
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



    public function properties()
    {
        return $this->hasMany(Property::class);
    }
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->email_verification_token = Str::random(60);
        });
    }
}
