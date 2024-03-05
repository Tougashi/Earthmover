<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function index()
    {
        return view('Pages.Dashboard.index', [
            'title' => 'Dashboard'
        ]); 
    }

    public function invoice($code)
    {

        $code = urldecode($code);
        $order = Order::where('code', $code)->firstOrFail();

        return view('Components.invoice', [ 
            'order' => $order,
            'products' => Product::all(),
        ]);
    }

    
}
