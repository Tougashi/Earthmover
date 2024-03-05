<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Pages.Customers.index', [
            'title' => 'Customers',
            'customers' => Customer::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Pages.Customers.create', [
            'title' => 'Add Customers',
            'customers' => Customer::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|unique:customers',
            'address' => 'nullable|string',
            'email' => 'nullable|email|unique:customers',
            'contact' => 'nullable|string|unique:customers',
        ]);

        $customer = new Customer;
        $customer->name = $validatedData['name'];
        $customer->address = $request->input('address');
        $customer->email = $request->input('email');
        $customer->contact = $request->input('contact');
        $customer->save();

        return response()->json(['message' => 'Customer has been created successfully.']);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $customer = Customer::find($id);
        $validatedData = $request->validate([
            'name' => 'required|string|unique:customers,name,' . $customer->id,
            'address' => 'nullable|string',
            'email' => 'nullable|email|unique:customers,email,' . $customer->id,
            'contact' => 'nullable|string|unique:customers,contact,' . $customer->id,
        ]);

        $customer->name = $validatedData['name'];
        $customer->address = $request->input('address');
        $customer->email = $request->input('email');
        $customer->contact = $request->input('contact');
        $customer->save();

        return response()->json(['message' => 'Customer has been updated successfully.']);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $customer = Customer::find(decrypt($id));
        $customer->delete();

        return response()->json(['message' => 'Customer has been deleted successfully.']);
    }
}
