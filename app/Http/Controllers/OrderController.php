<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Transaction;
use Faker\Factory as Faker;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    { 
        $order = Order::where('code')->firstOrFail();

        return view('Pages.Orders.index', [
            'title' => 'Orders',
            'orders' => Order::latest()->get(),
            'order' => $order,
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
            'customers' => Customer::all(),
            
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'customerId' => 'required|exists:customers,id',
            'productId' => 'required|array',
            'productId.*' => 'exists:products,id',
            'quantity' => 'required|array',
            'quantity.*' => 'integer|min:1',
            'totalPrice' => 'required|numeric|min:0',
        ]);

        $validatedData['productId'] = json_encode($validatedData['productId']);
        $validatedData['quantity'] = json_encode($validatedData['quantity']);
    
        $validatedData['userId'] = auth()->user()->id;
        $validatedData['date'] = now();

        $uniqueCode = Faker::create()->unique()->bothify('?#?#?#');
        while (Order::where('code', $uniqueCode)->exists()) {
            $uniqueCode = Faker::create()->unique()->bothify('?#?#?#');
        }
        $validatedData['code'] = $uniqueCode;

        Order::create($validatedData);

        foreach ($request->productId as $index => $productId) {
            $product = Product::find($productId);
            $product->stock -= $request->quantity[$index];
            $product->save();
        }
    
    
        return response()->json(['code' => $uniqueCode]);
    }   


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order, $id)
    {
        $order = Order::find( decrypt($id) );
        Order::destroy(decrypt($id));
        return response()->json(['message' => 'Order has been deleted successfully.']);
    }
}
