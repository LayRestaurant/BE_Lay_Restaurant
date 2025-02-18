<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    public $tablle = 'rooms';
    protected $fillable = [
        'name',
        'description',
        'price',
        'capacity',
        'status',
        'star_rating',
        'room_type',
        'most_booked_room',
        'restaurant_name',
        'image1',
        'image2',
        'image3'
    ];
}
