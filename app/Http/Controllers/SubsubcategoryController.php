<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Subsubcategory;
use Illuminate\Http\Request;

class SubsubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getSubsubcategory(Request $request)
    {
        //
        $request->validate([
            'subcategory_id' => 'required',
        ]);
        $subcategories = Subcategory::find($request->subcategory_id);

        if ($subcategories) {
            return response()->json([
                'success' => true,
                'message' => 'Categories fetched successfully',
                'data' => $subcategories->subsubcategories,
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
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories=Category::all();
        $subcategories=Subcategory::all();
        return view('admin.SubSubCategory.addSubSubCategory',compact('categories','subcategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255',
            'subcategory_id' => 'required',
        ]);
        $subsubcategory=new Subsubcategory();
        $subsubcategory->name=$request->name;
        $subsubcategory->subcategory_id=$request->subcategory_id;
        $subsubcategory->save();
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Subsubcategory $subsubcategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subsubcategory $subsubcategory)
    {
        //
        $categories=Category::all();
        $subcategories=Subcategory::where('category_id','=',$subsubcategory->subcategory->category_id)->get();
        return view('admin.SubSubCategory.editSubSubCategory', compact('subsubcategory','categories','subcategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subsubcategory $subsubcategory)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string',
            'subcategory_id' =>'required'
        ]);

        $subsubcategory->update($validatedData);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subsubcategory $subsubcategory)
    {
        //
        $subsubcategory->delete();
        return redirect()->route('categories.index')->with('success', 'SubCategory deleted successfully');
    }
}
