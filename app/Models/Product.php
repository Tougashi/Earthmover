<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'code', 'image', 'name', 'price', 'stock', 'description', 'categoryId', 'supplierId'
    ];

    public function Category()
    {
        return $this->belongsTo(Category::class, 'categoryId');
    }
    public function Supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplierId');
    }
    public function Order()
    {
        return $this->hasMany(Order::class);
    }
    public function image()
    {
        return $this->hasMany(Images::class);
    }
}
