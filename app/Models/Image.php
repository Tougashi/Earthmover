<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // protected static function boot()
    // {
    //     parent::boot();

    //     static::deleting(function($image) {
    //         Storage::delete($image->image);
    //     });
    // }

    public function product()
    {
        return $this->belongsTo(Product::class, 'productId', 'id');
    }
}
