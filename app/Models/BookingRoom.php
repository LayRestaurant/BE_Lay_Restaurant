<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingRoom extends Model
{
    use HasFactory;
    public $table = 'booking_rooms';
    protected $fillable = [
        'user_id', 'room_id', 'check_in_date', 'check_out_date', 'price', 'status', 'payment_status', 'number_of_days'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
