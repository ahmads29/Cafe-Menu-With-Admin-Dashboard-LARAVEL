<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use App\Models\Subsubcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $products=Product::all();
        return view('admin.Product.products',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories=Category::all();
        return view('admin.Product.addProduct',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'subsubcategory_id' => 'required',
            'description' => 'nullable|string',
            'price' => 'required',
        ]);
        try{
            $product = new Product();
            $product->name = $request->input('name');
            $product->subsubcategory_id = $request->input('subsubcategory_id'); // Save the category
            $product->description = $request->input('description'); // Save the description
            $product->price = $request->input('price'); // Save the price
            $product->save(); // Save the product
            return redirect()->route('products.index');

        }catch(\Exception $e){
            dd($e);
            return redirect()->route('products.index');
        }
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
        $categories=Category::all();
        $subcategories=Subcategory::where('category_id','=',$product->subsubcategory->subcategory->category_id)->get();
        $subsubcategories=Subsubcategory::where('subcategory_id','=',$product->subsubcategory->subcategory_id)->get();
        return view('admin.Product.editProduct', compact('product','categories','subcategories','subsubcategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string',
            'price' => 'required',
            'description' => 'nullable|string',
            'subsubcategory_id' => 'required',
        ]);

        // if ($request->hasFile('image')) {
        //     $imagePath = $request->file('image')->store('images', 'public');
        //     $validatedData['img'] = $imagePath;

        //     if ($product->image) {
        //         Storage::disk('public')->delete($product->image);
        //     }
        // }else{
        //     $validatedData['img'] = $product->img;
        // }
        $product->update($validatedData);

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
