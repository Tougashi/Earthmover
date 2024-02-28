<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Session;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();

        $images = [];
        foreach ($products as $product) {
            $images[$product->id] = Image::where('productId', $product->id)->get();
        }
        $title =  'Products';
        return view('Pages.Products.index', [
            'title' => $title,
            'categories' => Category::all(),
            'products' => $products,
            'images' => $images,
        ]); 
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Add Product';
        return view('Pages.Products.create', [
            'title' => $title,
            'category' => Category::all(),
        ]); 
    }

    public function store(Request $request)
    {
        $image = array();
        $request->validate([
            'code' => 'required|string',
            'name' => 'required|string',
            'image.*' => 'nullable|file|mimes:jpeg,jpg,png,gif,svg|max:10240',
            'description' => 'nullable|string',
            'stock' => 'required|integer',
            'price' => 'required|numeric',
            'type' => 'required|string|in:Male,Female,Unisex',
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
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $value) {
                $originalName = $value->getClientOriginalName();
                $imageName = time() . '_' . $originalName;
                $path = 'images/products/' . $imageName;
                $value->storeAs('/images/products/', $imageName);
                Image::create([
                    'image' => $path,
                    'productId' => $product->id,
                ]);
            }
        }
        
        return response()->json(['message' => 'Data has been saved successfully.']);
    }

    public function show(Product $product, $id)
    {
        $productId = decrypt($id);
        $products = Product::find($productId);
        $images = Image::where('productId', $productId)->get();
        $title = 'Detail Product';
        return view('Pages.Products.show', [
            'title' => $title,
            'category' => Category::all(),
            'products' => $products,
            'images' => $images,
        ]); 
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product, $id)
    {
        $productId = decrypt($id);
        $products = Product::find($productId);
        $images = Image::where('productId', $productId)->get();
        $title = 'Edit Product';
        return view('Pages.Products.edit', [
            'title' => $title,
            'category' => Category::all(),
            'products' => $products,
            'images' => $images,
        ]); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $product = Product::find(decrypt($id));
        
        $request->validate([
            'code' => 'string',
            'name' => 'string',  
            'description' => 'nullable|string',
            'stock' => 'integer',
            'price' => 'numeric',
            'type' => 'string|in:Male,Female,Unisex',
            'supplierId' => 'nullable|exists:suppliers,id',
            'categoryId' => 'exists:categories,id',
        ]);

        $requestData = $request->only(['code', 'name', 'description', 'stock', 'price', 'type', 'supplierId', 'categoryId']);
        $product->update($requestData);
    
        if ($request->hasFile('image')) {
            // foreach ($product->images as $image) {
            //     Storage::delete($image->image);
            //     $image->delete();
            // }
            
             foreach ($request->file('image') as $value) {
                $originalName = $value->getClientOriginalName();
                $imageName = time() . '_' . $originalName;
                $path = 'images/products/' . $imageName;
                $value->storeAs('/images/products/', $imageName);
                Image::create([
                    'image' => $path,
                    'productId' => $product->id,
                ]);
            }
        }
    
        return response()->json(['message' => 'Product has been updated successfully.']);
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($encryptedId)
    {
        $id = decrypt($encryptedId);
        
        $product = Product::findOrFail($id);
        $product->delete();
    
        return response()->json(['message' => 'Product and related images have been deleted successfully.']);
    }
    


}