<?php

namespace App\Http\Controllers;

use App\Mail\InvoiceMailable;
use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ViewController extends Controller
{
    public function index()
    {   
        $orders = Order::all();
        $totalOrders = Order::count();
        $totalRevenue = Order::sum('totalPrice');
        $totalCustomers = Customer::count();
        $totalProductsSold = Order::sum('quantity');
        
        $lastMonthTotalOrders = Order::whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->subMonth()->month)
            ->count();
        $lastMonthTotalRevenue = Order::whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->subMonth()->month)
            ->sum('totalPrice');
            $percentageChangeTotalOrders = $lastMonthTotalOrders ? number_format((($totalOrders - $lastMonthTotalOrders) / $lastMonthTotalOrders) * 100, 2, '.', '') : 0;
            $percentageChangeTotalRevenue = $lastMonthTotalRevenue ? number_format((($totalRevenue - $lastMonthTotalRevenue) / $lastMonthTotalRevenue) * 100, 2, '.', '') : 0;
            
        
        $ordersPerDay = [
            'Sunday' => 0,
            'Monday' => 0,
            'Tuesday' => 0,
            'Wednesday' => 0,
            'Thursday' => 0,
            'Friday' => 0,
            'Saturday' => 0
        ];
        $revenuePerDay = [
            'Sunday' => 0,
            'Monday' => 0,
            'Tuesday' => 0,
            'Wednesday' => 0,
            'Thursday' => 0,
            'Friday' => 0,
            'Saturday' => 0
        ];

        foreach ($orders as $order) {
            $dayOfWeek = date('l', strtotime($order->created_at));
            $ordersPerDay[$dayOfWeek]++;
            $revenuePerDay[$dayOfWeek] += $order->totalPrice;
        }

        $orderCounts = array_values($ordersPerDay);
        $revenueCounts = array_values($revenuePerDay);

        return view('Pages.Dashboard.index', [
            'title' => 'Dashboard',
            'totalOrders' => $totalOrders,
            'totalProductsSold' => $totalProductsSold,
            'totalRevenue' => $totalRevenue,
            'totalCustomers' => $totalCustomers,
            'percentageChangeTotalOrders' => $percentageChangeTotalOrders,
            'percentageChangeTotalRevenue' => $percentageChangeTotalRevenue,
            'orderCounts' => $orderCounts,
            'revenueCounts' => $revenueCounts
        ]); 
    }


    public function invoice($code)
    {
        $code = urldecode($code);
        $order = Order::where('code', $code)->firstOrFail();
        
        $products = Product::all(); 
        if ($order->customer->email) {
            Mail::to($order->customer->email)->send(new InvoiceMailable($order, $products));
        }
    
        return view('Components.invoice', [ 
            'order' => $order,
            'products' => $products, 
        ]);
    }


    
}
