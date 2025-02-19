<?php

// app/Http/Controllers/MenuController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Product;
use App\Models\Subsubcategory;

class MenuController extends Controller
{
    // Fetch subcategories for a selected category
    public function fetchSubcategory(Request $request)
    {
        $categoryId = $request->input('category_id');
        $category = Category::with('subcategories.subsubcategories.products')->find($categoryId); // Load sub-subcategories
        if ($category) {
            return response()->json([
                'success' => true,
                'data' => $category->subcategories
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Category not found.'
        ]);
    }

    // Fetch menu items for a selected subcategory
    public function fetchMenuItems(Request $request)
    {
        $subcategoryId = $request->input('subcategory_id');
        $subsubcategories = Subsubcategory::with('products')->where('subcategory_id','=',$subcategoryId)->get();
        if ($subsubcategories) {
            return response()->json([
                'success' => true,
                'data' => $subsubcategories
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Subcategory not found.'
        ]);
    }
}
