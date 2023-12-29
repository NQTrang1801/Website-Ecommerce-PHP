<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\home\CartHomeController;
use App\Http\Controllers\home\ProductHomeController;
use App\Http\Controllers\home\IndexPageHomeController;
use App\Http\Controllers\home\CategoriesPageHomeController;
use App\Http\Controllers\home\CategoryHomeController;
use App\Http\Controllers\home\SubCategoryHomeController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\SubCategoryController;
use App\Http\Controllers\admin\TempImagesController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\SizeController;
use App\Http\Controllers\admin\ColorController;
use App\Http\Controllers\admin\PromotionController;
use App\Http\Controllers\admin\VariantsController;
use App\Http\Controllers\admin\UserController;
use App\Models\Variants;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

Route::get('/redirect', [HomeController::class, 'redirect']);

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::group(['middleware' => 'check.usertype'], function () {
    // User
    Route::get('/users/staff', [UserController::class, 'indexStaff'])->name('users.indexStaff');
    Route::get('/users/customer', [UserController::class, 'indexCustomer'])->name('users.indexCustomer');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.delete');

    // Category management
    Route::prefix('/categories')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('/insert', [CategoryController::class, 'create'])->name('categories.create');
        Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::put('/{category}', [CategoryController::class, 'update'])->name('categories.update');
        Route::put('/{category}/showHome', [CategoryController::class, 'showHome'])->name('categories.showHome');
        Route::put('/{category}/isFeatured', [CategoryController::class, 'isFeatured'])->name('categories.isFeatured');
        Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('categories.delete');
        Route::post('/', [CategoryController::class, 'store'])->name('categories.store');
    });

    // Sub Category
    Route::prefix('/sub-categories')->group(function () {
        Route::get('/', [SubCategoryController::class, 'index'])->name('sub-categories.index');
        Route::get('/insert', [SubCategoryController::class, 'create'])->name('sub-categories.create');
        Route::post('/', [SubCategoryController::class, 'store'])->name('sub-categories.store');
        Route::get('/{subcategory}/edit', [SubCategoryController::class, 'edit'])->name('sub-categories.edit');
        Route::put('/{subcategory}', [SubCategoryController::class, 'update'])->name('sub-categories.update');
        Route::put('/{subcategory}/showHome', [SubCategoryController::class, 'showHome'])->name('sub-categories.showHome');
        Route::put('/{subcategory}/isFeatured', [SubCategoryController::class, 'isFeatured'])->name('sub-categories.isFeatured');
        Route::delete('/{subcategory}', [SubCategoryController::class, 'destroy'])->name('sub-categories.delete');
    });

    // ... (Other grouped routes)
    // Size
    Route::prefix('/sizes')->group(function () {
        Route::get('/', [SizeController::class,'index'])->name('sizes.index');
        Route::get('/insert', [SizeController::class, 'create'])->name('sizes.create');
        Route::post('/', [SizeController::class, 'store'])->name('sizes.store');
        Route::get('/{size}/edit', [SizeController::class, 'edit'])->name('sizes.edit');
        Route::put('/{size}', [SizeController::class, 'update'])->name('sizes.update');
        Route::delete('/{size}', [SizeController::class, 'destroy'])->name('sizes.delete');
    });

    // Color
    Route::prefix('/colors')->group(function () {
        Route::get('/', [ColorController::class,'index'])->name('colors.index');
        Route::get('/insert', [ColorController::class, 'create'])->name('colors.create');
        Route::post('/', [ColorController::class, 'store'])->name('colors.store');
        Route::get('/{color}/edit', [ColorController::class, 'edit'])->name('colors.edit');
        Route::put('/{color}', [ColorController::class, 'update'])->name('colors.update');
        Route::delete('/{color}', [ColorController::class, 'destroy'])->name('colors.delete');
    });

    // Promotion
    Route::prefix('/promotions')->group(function () {
        Route::get('/', [PromotionController::class,'index'])->name('promotions.index');
        Route::get('/insert', [PromotionController::class, 'create'])->name('promotions.create');
        Route::post('/', [PromotionController::class, 'store'])->name('promotions.store');
        Route::get('/{promotion}/edit', [PromotionController::class, 'edit'])->name('promotions.edit');
        Route::put('/{promotion}', [PromotionController::class, 'update'])->name('promotions.update');
        Route::delete('/{promotion}', [PromotionController::class, 'destroy'])->name('promotions.delete');
    });

    // Product
    Route::prefix('/products')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('products.index');
        Route::get('/insert', [ProductController::class, 'create'])->name('products.create');
        Route::post('/', [ProductController::class, 'store'])->name('products.store');
        Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('/{product}', [ProductController::class, 'update'])->name('products.update');
        Route::put('/{product}/showHome', [ProductController::class, 'showHome'])->name('products.showHome');
        Route::put('/{product}/isFeatured', [ProductController::class, 'isFeatured'])->name('products.isFeatured');
        Route::delete('/{product}', [ProductController::class, 'destroy'])->name('products.delete');
    });


    // Variants
    Route::prefix('/variantss')->group(function () {
        Route::get('/', [VariantsController::class,'index'])->name('variantss.index');
        Route::get('/insert', [VariantsController::class, 'create'])->name('variantss.create');
        Route::get('/{product}/add', [VariantsController::class, 'add'])->name('products.add');
        Route::post('/', [VariantsController::class, 'store'])->name('variantss.store');
        Route::put('/{variant}', [VariantsController::class, 'update'])->name('variantss.update');
        Route::delete('/{variant}', [VariantsController::class, 'destroy'])->name('variantss.delete');
    });

    // Temp Images
    Route::post('/upload-temp-image', [TempImagesController::class, 'create'])->name('temp-images.create');
});

// Non-grouped routes
Route::get('/', [IndexPageHomeController::class, 'index'])->name('home.index');
Route::get('/profile', [HomeController::class, 'profile'])->name('home.profileshow');
Route::get('/categories/{type}/{subtype?}', [CategoriesPageHomeController::class, 'index'])->name('home.categories.index');
Route::get('/get-featured-categories', [CategoryHomeController::class, 'getIsFeatured'])->name('categories.getIsFeatured');
Route::get('/get-featured-sub-categories', [SubCategoryHomeController::class, 'getIsFeatured'])->name('sub-categories.getIsFeatured');
Route::get('/products/{id}', [ProductHomeController::class, 'index'])->name('home.productDetail.index');;
Route::get('/products/{id}/{color}/{size}/{index}', [HomeController::class, 'productUpdate']);
Route::get('/cart', [HomeController::class, 'cart']);
Route::get('/checkout/{cost}', [HomeController::class, 'checkout']);
Route::get('/order-history', [HomeController::class, 'orderHistory'])->name('user.order-histories');
Route::get('/services', [HomeController::class, 'services'])->name('home.services');
Route::get('/get-sizes-by-color/{productId}/{colorId}', [ProductHomeController::class, 'getSizesByColor'])->name('home.productDetail.getSizeByColor');

//search
Route::get('/search/products', [ProductHomeController::class, 'getByKeyWord'])->name('search.products.keyword');
Route::get('/getSubCategories/{categoryId}', [SubCategoryController::class, 'getSubCategories']);

//Cart
Route::post('/add-to-cart-default', [CartHomeController::class, 'addToCartDefault'])->name('cart.addToCartDefault');
Route::get('/getSlug', function (Request $request) {
    $slug = '';
    if (!empty($request->title)) {
        $slug = Str::slug($request->title);
    }

    return response()->json([
        'status' => true,
        'slug' => $slug
    ]);
})->name('getSlug');

  
