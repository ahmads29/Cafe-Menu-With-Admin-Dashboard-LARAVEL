<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Subsubcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $subcategories=Subcategory::all();
        $subsubcategories=Subsubcategory::all();
        $categories=Category::all();

        return view('admin.Category.categories',compact('categories','subcategories','subsubcategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.Category.addCategory');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if ($request->hasFile('icon')) {
            $image = $request->file('icon');
            $imagePath = $image->store('icon', 'public');
        }
        $category=new Category();
        $category->name=$request->name;
        $category->icon=$imagePath;
        $category->save();
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
        return view('admin.Category.editCategory', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string',
        ]);

        if ($request->hasFile('icon')) {
            $imagePath = $request->file('icon')->store('icon', 'public');
            $validatedData['icon'] = $imagePath;
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }
            $file = $request->file('icon');
            $fileName = time() . rand(1000, 50000) . '.' . $file->getClientOriginalExtension();
            $file->move('upload/', $fileName);
            // $uploadFile = 'upload/' . $fileName;
        }else{
            $validatedData['icon'] = $category->icon;
        }
        $category->update($validatedData);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully');
    }
}
