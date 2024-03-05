<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected static function boot()
    {
        parent::boot();

        static::deleting(function($product) {
            $images = Image::where('productId', $product->id)->get();
            foreach ($images as $item) {
                Storage::disk()->delete($item->image);
                $item->delete();
            }

            $orders = Order::all();

            foreach ($orders as $order) {
                $productIds = json_decode($order->productId);

                if (in_array($product->id, $productIds)) {
                    $order->delete();
                }
            }
        });
    }

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
        return $this->hasMany(Image::class, 'productId', 'id');
    }
}
