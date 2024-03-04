<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'code', 'quantity', 'totalPrice', 'date', 'userId', 'customerId', 'productId'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'productId');
    }
    public function Transaction()
    {
        return $this->belongsTo(Transaction::class, 'orderId');
    }
    public function User()
    {
        return $this->belongsTo(User::class, 'userId');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customerId');
    }

}
