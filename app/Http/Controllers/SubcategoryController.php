<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getSubcategory(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
        ]);
        $categories = Category::find($request->category_id);

        if ($categories) {
            return response()->json([
                'success' => true,
                'message' => 'Categories fetched successfully',
                'data' => $categories->subcategories,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Category not found',
                'data' => null
            ], 404);
        }
    }
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories=Category::all();
        return view('admin.SubCategory.addSubCategory',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required',
        ]);
        $subcategory=new Subcategory();
        $subcategory->name=$request->name;
        $subcategory->category_id=$request->category_id;
        $subcategory->save();
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Subcategory $subcategory)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subcategory $subcategory)
    {
        //
        $categories=Category::all();
        return view('admin.SubCategory.editSubCategory', compact('subcategory','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subcategory $subcategory)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string',
            'category_id' =>'required'
        ]);

        $subcategory->update($validatedData);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subcategory $subcategory)
    {
        //
        $subcategory->delete();
        return redirect()->route('categories.index')->with('success', 'SubCategory deleted successfully');
    }
}
