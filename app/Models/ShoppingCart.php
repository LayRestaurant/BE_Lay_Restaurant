<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    use HasFactory;

    protected $table = 'shopping_cart'; // Ensure the table name is correct

    protected $fillable = [
        'user_id',
        'food_id', // Include 'food_id' in fillable to allow mass assignment
        'quantity',
        'total_price',
    ];

    // Define the relationship with the Food model
    public function food()
    {
        return $this->belongsTo(Food::class);
    }
}
