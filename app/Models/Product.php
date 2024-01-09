<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'price', 'stock', 'description', 'image', 'categoryId'
    ];

    public function Category()
    {
        return $this->belongsTo(Category::class, 'categoryId');
    }
    public function Order()
    {
        return $this->hasMany(Order::class);
    }
}
