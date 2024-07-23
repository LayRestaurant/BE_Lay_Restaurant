<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingFoodItem extends Model
{
    use HasFactory;

    public $table = "booking_food_items";

    protected $fillable = [
        'booking_id',
        'food_id',
        'quantity',
        'price',
        'total_price',
    ];

    public function booking()
    {
        return $this->belongsTo(BookingFood::class, 'booking_id');
    }

    public function food()
    {
        return $this->belongsTo(Food::class);
    }
}
