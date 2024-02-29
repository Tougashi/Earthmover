<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function Product()
    {
        return $this->belongsTo(Product::class, 'productId');
    }
    public function Transaction()
    {
        return $this->belongsTo(Transaction::class, 'transactionId');
    }
    public function User()
    {
        return $this->belongsTo(User::class, 'userId');
    }
}
