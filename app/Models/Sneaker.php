<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sneaker extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand',
        'model',
        'color',
        'price',
        'image_url',
        'description',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}

