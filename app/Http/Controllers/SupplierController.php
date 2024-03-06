<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         return view('Pages.Suppliers.index', [
            'title' => 'Suppliers',
            'suppliers' => Supplier::latest()->get()
        ]);
    }

   /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Pages.Suppliers.create', [
            'title' => 'Add Supplier',
            'suppliers' => Supplier::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|unique:suppliers',
            'address' => 'nullable|string',
            'email' => 'nullable|email:dns|email:rfc|unique:suppliers',
            'contact' => 'nullable|string|unique:suppliers',
        ]);

        $supplier = new Supplier;
        $supplier->name = $validatedData['name'];
        $supplier->address = $request->input('address');
        $supplier->email = $request->input('email');
        $supplier->contact = $request->input('contact');
        $supplier->save();

        return response()->json(['message' => 'Supplier has been created successfully.']);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $supplier = Supplier::find(decrypt($id));
        $validatedData = $request->validate([
            'name' => 'required|string|unique:suppliers,name,' . $supplier->id,
            'address' => 'nullable|string',
            'email' => 'nullable|email|unique:suppliers,email,' . $supplier->id,
            'contact' => 'nullable|string|unique:suppliers,contact,' . $supplier->id,
        ]);

        $supplier->name = $validatedData['name'];
        $supplier->address = $request->input('address');
        $supplier->email = $request->input('email');
        $supplier->contact = $request->input('contact');
        $supplier->update();

        return response()->json(['message' => 'Supplier has been updated successfully.']);
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $supplier = Supplier::find(decrypt($id));
        $supplier->delete();

        return response()->json(['message' => 'Supplier has been deleted successfully.']);
    }
}
