<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    public $timestamps = false;

    // protected $table = 'food'; // You can uncomment this line if needed

    protected $fillable = [
        'name',
        'price',
        'description',
        'type',
        'picture',
    ];

    // Define the inverse relationship with the ShoppingCart model
    public function shoppingCarts()
    {
        return $this->hasMany(ShoppingCart::class);
    }
}
