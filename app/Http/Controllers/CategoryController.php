<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Pages.Categories.index', [
            'title' => 'Categories',
            'categories' => Category::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Pages.Categories.create', [
            'title' => 'Add Categories',
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'name' => 'required|string|unique:categories',
            'description' => 'nullable|string',
        ]);

        $slug = Str::slug(strtolower($validatedData['name']));

        $category = new Category;
        $category->name = $validatedData['name'];
        $category->slug = $slug;
        $category->description = $request->description;
        $category->save();

        return response()->json(['message' => 'Category has been created successfully.']);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $category = Category::find(decrypt($id));
        $validatedData = $request->validate([
            'name' => 'required|string|unique:categories,name,' . $category->id,
            'description' => 'nullable|string',
        ]);

        $slug = Str::slug(strtolower($validatedData['name']));

        $category->name = $validatedData['name'];
        $category->slug = $slug;
        $category->description = $request->description;
        $category->save();

        return response()->json(['message' => 'Category has been updated successfully.']);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        Category::destroy(decrypt($id));
    
        return response()->json(['message' => 'Category has been deleted successfully.']);
    }
}
