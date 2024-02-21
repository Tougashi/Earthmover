<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Images;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Pages.Products.index', [
            'title' => 'Products',
            'category' => Category::all(),
            'product' => Product::all(),
        ]); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Pages.Products.add', [
            'title' => 'Add Product',
            'category' => Category::all(),
        ]); 
    }

    public function store(Request $request)
    {
        $image = array();
        $request->validate([
            'code' => 'required|string',
            'name' => 'required|string',
            'image.*' => 'required|file|mimes:jpeg,jpg,png,gif,svg|max:10240',
            'description' => 'nullable|string',
            'stock' => 'required|integer',
            'price' => 'required|numeric',
            'type' => 'required|string|in:male,female,unisex',
            'supplierId' => 'nullable|exists:suppliers,id',
            'categoryId' => 'required|exists:categories,id',
        ]);
    
        $product = Product::create([
            'code' => $request->code,
            'name' => $request->name,
            'description' => $request->description,
            'stock' => $request->stock,
            'price' => $request->price,
            'type' => $request->type,
            'supplierId' => $request->supplierId,
            'categoryId' => $request->categoryId,
        ]);

        foreach ($request->file('image') as $value) {
            $originalName = $value->getClientOriginalName();
            $imageName = time() . '_' . $originalName;
            $path = 'image/' . $imageName;
            $value->storeAs('/public/image', $imageName); 
        
            Images::create([
                'image' => $path,
                'productId' => $product->id,
            ]);
        }

        return redirect()->back()->with('success', 'Product created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
