<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::latest()->get();
        return view('Pages.Orders.index', [
            'title' => 'Transactions',
            'orders' => $orders,
        ]);
    }
    
    public function getOrderDetails(Request $request)
    {
        $code = decrypt($request->code);
        $order = Order::where('code', $code)->first();
        $products = Product::all();

        $orderDetails = '';
        $totalQuantity = 0;
        $grandTotal = 0;

        foreach (json_decode($order->productId) as $key => $productId) {
            $product = $products->where('id', $productId)->first();
            $quantity = json_decode($order->quantity)[$key];
            $subtotal = $product->price * $quantity;
            $totalQuantity += $quantity;
            $grandTotal += $subtotal;

            $orderDetails .= '<tr>
                                <td class="no text-center">' . ($key + 1) . '</td>
                                <td class="product text-center">' . $product->name . ' (' . $product->category->name . ')</td>
                                <td class="qty text-center">' . $quantity . '</td>
                                <td class="price text-center">$' . $product->price . '</td>
                                <td class="subtotal text-center">$' . $subtotal . '</td>
                            </tr>';
        }

        return response()->json([
            'orderDetails' => $orderDetails,
            'grandTotal' => $grandTotal,
            'orderCode' => $order->code, 
            'customerName' => $order->customer->name, 
            'orderDate' => \Carbon\Carbon::parse($order->date)->format('l, j F Y')
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
