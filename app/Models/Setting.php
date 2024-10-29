<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    // Khai báo các thuộc tính có thể gán hàng loạt
    protected $fillable = [
        'theme',
        'language',
        'notifications_enabled',
        'max_items',
    ];

    
}
