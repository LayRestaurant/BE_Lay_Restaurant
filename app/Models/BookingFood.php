<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingFood extends Model
{
    use HasFactory;
    public $table = 'booking_food';

    protected $fillable = [
        'user_id',
        'order_number',
        'order_date',
        'total_amount',
        'status',
        'payment_method',
        'delivery_address',
        'note',
    ];

    public function items()
    {
        return $this->hasMany(BookingFoodItem::class, 'booking_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
