<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Faker\Factory as Faker;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Pages.Orders.index', [
            'title' => 'Orders',
            'order' => Order::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Pages.Orders.create', [
            'title' => 'Add Orders',
            'products' => Product::all(),
            'users' => User::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'productId' => 'required|exists:products,id',
            'userId' => 'required|exists:users,id', 
            'quantity' => 'required|integer|min:1',
            'totalPrice' => 'required|numeric|min:0', 
        ]);

        $productId = $request->input('productId');
        $userId = $request->input('userId'); 

        $faker = Faker::create();
        $code = '#' . $faker->bothify('???##?');
        $quantity = $request->input('quantity');
        $totalPrice = $request->input('totalPrice');
        $date = now(); 

        $order = new Order();
        $order->productId = $productId;
        $order->userId = $userId;
        $order->code = $code;
        $order->quantity = $quantity;
        $order->totalPrice = $totalPrice;
        $order->date = $date;
        $order->save();

        return response()->json(['message' => 'Order created successfully']);
    }


    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
