<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'location',
        'lat',
        'lng',
        'type',
        'type_of_rent',
        'bedrooms',
        'bathrooms',
        'parking_spaces',
        'square_footage',
        'furnishing',
        'flooring',
        'water_supply',
        'amenities',
        'price',
        'currency',
        'payment_frequency',
        'photos',
        'videos',
        'virtual_tour',
        'additional_information',
        'status',
        'featured',
        'highlighted',
        'views',
        'likes',
        'dislikes',
        'comments',
    ];

    protected $casts = [
        'photos' => 'array',
        'videos' => 'json',
        'comments' => 'json',
        'featured' => 'boolean',
        'highlighted' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
