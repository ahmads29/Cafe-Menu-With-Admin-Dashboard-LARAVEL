<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\SubsubcategoryController;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

// Route::post('/fetch-subcategory', [MenuController::class, 'fetchSubcategory'])->name('fetch.subcategory');

// // Route to fetch menu items
Route::post('/fetch-menu-items', [MenuController::class, 'fetchMenuItems'])->name('fetch.menu.items');

Route::get('/', function () {

    $categories = Category::all();

    // Set a default category (e.g., the first category)
    $defaultCategory = Category::with('subcategories.subsubcategories.products')->first();

    // Pass the default category and all categories to the view
    return view('index', [
        'categories' => $categories,
        'defaultCategory' => $defaultCategory
    ]);
});
// Route::resource('admin/category/{categoryId}/subcategory ', SubcategoryController::class);
Route::get('/login', function () {
    return view('admin.login');
})->name('login');
Route::post('/fetch-subcategory',[SubcategoryController::class,'getSubcategory']);
Route::post('/fetch-subsubcategory',[SubsubcategoryController::class,'getSubsubcategory']);
Route::post('/fetch-menu-subcategory',[MenuController::class,'fetchSubcategory']);
Route::post('/fetch-subsubcategory',[MenuController::class,'fetchMenuItems']);
Route::middleware(['auth'])->group(function () {
    Route::resource('admin/products',ProductController::class);
    Route::resource('admin/categories',CategoryController::class);
    Route::resource('admin/categories/subcategories',SubcategoryController::class);
    Route::resource('admin/categories/subsubcategories',SubsubcategoryController::class);
    Route::get('/admin', function () {
        return view('admin.index');
    })->name('admin');

    Route::get('/admin/settings', function () {
        return view('admin.settings');
    })->name("settings");

    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('admin/change-password', [AuthController::class, 'changePassword'])->name('admin.change-password');

});

Route::get('/createuser', function () {
    $email="zakariakhatib13@gmail.com";
    $password='Zakaria17';
    $user = new User();
    $user->name="Zakaria";
    $user->email=$email;
    $user->password = Hash::make($password);
    $user->save();
    Auth::login($user);
});
Route::post('login', [AuthController::class, 'login'])->name('login');
