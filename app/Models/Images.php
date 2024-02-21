<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    use HasFactory;

    protected $fillable = [
        'image', 'productId'
    ];

    // protected $table = 'image';
    public $timestamps = false;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
