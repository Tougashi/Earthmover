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
        $orders = Order::all();

        $groupedOrders = $orders->groupBy('code');
        return view('Pages.Orders.index', [
            'title' => 'Orders',
            'order' => Order::latest()->get(),
            'groupedOrders' => $groupedOrders
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
            'productId' => 'required|array',
            'productId.*' => 'exists:products,id',
            'userId' => 'required|exists:users,id',
            'quantity' => 'required|array',
            'quantity.*' => 'integer|min:1',
            'totalPrice' => 'required|numeric|min:0',
        ]);
    
        // Ambil data dari request
        $productIds = $request->input('productId');
        $userId = $request->input('userId');
        $quantities = $request->input('quantity');
        $totalPrice = $request->input('totalPrice');
    
        // Generate kode pesanan menggunakan Faker
        $faker = Faker::create();
        $code = '#' . $faker->bothify('???##?');
    
        // Simpan setiap pesanan ke database
        foreach ($productIds as $key => $productId) {
            $order = new Order();
            $order->productId = $productId;
            $order->userId = $userId;
            $order->code = $code;
            $order->quantity = $quantities[$key]; // Ambil quantity sesuai indeks
            $order->totalPrice = $totalPrice;
            $order->date = now();
            $order->save();
        }
    
        return response()->json(['message' => 'Orders created successfully']);
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
