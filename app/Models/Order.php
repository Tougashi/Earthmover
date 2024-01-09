<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantity', 'totalPrice', 'productId', 'transactionId', 'userId'
    ];

    public function Product()
    {
        return $this->hasMany(Product::class, 'productId');
    }
    public function Transaction()
    {
        return $this->hasMany(Transaction::class, 'transactionId');
    }
    public function User()
    {
        return $this->hasMany(User::class, 'userId');
    }
}
