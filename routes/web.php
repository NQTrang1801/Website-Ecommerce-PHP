<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
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

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

route::get('/redirect',[HomeController::class,'redirect']);

// User
route::get('/users/staff',[UserController::class,'indexStaff'])
    ->middleware('check.usertype')
    ->name('users.indexStaff');

route::get('/users/customer',[UserController::class,'indexCustomer'])
    ->middleware('check.usertype')
    ->name('users.indexCustomer');

route::delete('/users/{user}', [UserController::class, 'destroy'])
    ->middleware('check.usertype')
    ->name('users.delete');

// Category management
route::get('/categories',[CategoryController::class,'index'])
    ->middleware('check.usertype')
    ->name('categories.index');

route::get('/categories/insert', [CategoryController::class, 'create'])
    ->middleware('check.usertype')
    ->name('categories.create');

route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])
    ->middleware('check.usertype')
    ->name('categories.edit');

route::put('/categories/{category}', [CategoryController::class, 'update'])
    ->middleware('check.usertype')
    ->name('categories.update');

route::put('/categories/{category}/showHome', [CategoryController::class, 'showHome'])
    ->middleware('check.usertype')
    ->name('categories.showHome');

route::delete('/categories/{category}', [CategoryController::class, 'destroy'])
    ->middleware('check.usertype')
    ->name('categories.delete');

route::post('/categories', [CategoryController::class, 'store'])
    ->middleware('check.usertype')
    ->name('categories.store');

// sub category
route::get('/sub-categories',[SubCategoryController::class,'index'])
    ->middleware('check.usertype')
    ->name('sub-categories.index');
route::get('/sub-categories/insert', [SubCategoryController::class, 'create'])
    ->middleware('check.usertype')
    ->name('sub-categories.create');
    
route::post('/sub-categories', [SubCategoryController::class, 'store'])
    ->middleware('check.usertype')
    ->name('sub-categories.store');
route::get('/sub-categories/{subcategory}/edit', [SubCategoryController::class, 'edit'])
    ->middleware('check.usertype')
    ->name('sub-categories.edit');
route::put('/sub-categories/{subcategory}', [SubCategoryController::class, 'update'])
    ->middleware('check.usertype')
    ->name('sub-categories.update');
route::delete('/sub-categories/{subcategory}', [SubCategoryController::class, 'destroy'])
    ->middleware('check.usertype')
    ->name('sub-categories.delete');

// Size
route::get('/sizes',[SizeController::class,'index'])
    ->middleware('check.usertype')
    ->name('sizes.index');

route::get('/sizes/insert', [SizeController::class, 'create'])
    ->middleware('check.usertype')
    ->name('sizes.create');
    
route::post('/sizes', [SizeController::class, 'store'])
    ->middleware('check.usertype')
    ->name('sizes.store');
route::get('/sizes/{size}/edit', [SizeController::class, 'edit'])
    ->middleware('check.usertype')
    ->name('sizes.edit');

route::put('/sizes/{size}', [SizeController::class, 'update'])
    ->middleware('check.usertype')
    ->name('sizes.update');
route::delete('/sizes/{size}', [SizeController::class, 'destroy'])
    ->middleware('check.usertype')
    ->name('sizes.delete');

// Color
route::get('/colors',[ColorController::class,'index'])
    ->middleware('check.usertype')
    ->name('colors.index');

route::get('/colors/insert', [ColorController::class, 'create'])
    ->middleware('check.usertype')
    ->name('colors.create');
    
route::post('/colors', [ColorController::class, 'store'])
    ->middleware('check.usertype')
    ->name('colors.store');
route::get('/colors/{color}/edit', [ColorController::class, 'edit'])
    ->middleware('check.usertype')
    ->name('colors.edit');

route::put('/colors/{color}', [ColorController::class, 'update'])
    ->middleware('check.usertype')
    ->name('colors.update');
route::delete('/colors/{color}', [ColorController::class, 'destroy'])
    ->middleware('check.usertype')
    ->name('colors.delete');

// Promotion
route::get('/promotions',[PromotionController::class,'index'])
    ->middleware('check.usertype')
    ->name('promotions.index');

route::get('/promotions/insert', [PromotionController::class, 'create'])
    ->middleware('check.usertype')
    ->name('promotions.create');
    
route::post('/promotions', [PromotionController::class, 'store'])
    ->middleware('check.usertype')
    ->name('promotions.store');
route::get('/promotions/{promotion}/edit', [PromotionController::class, 'edit'])
    ->middleware('check.usertype')
    ->name('promotions.edit');

route::put('/promotions/{promotion}', [PromotionController::class, 'update'])
    ->middleware('check.usertype')
    ->name('promotions.update');

route::delete('/promotions/{promotion}', [PromotionController::class, 'destroy'])
    ->middleware('check.usertype')
    ->name('promotions.delete');

// Product
route::get('/products',[ProductController::class,'index'])
    ->middleware('check.usertype')
    ->name('products.index');
route::get('/products/insert', [ProductController::class, 'create'])
    ->middleware('check.usertype')
    ->name('products.create');

route::get('/products/{product}/edit', [ProductController::class, 'edit'])
    ->middleware('check.usertype')
    ->name('products.edit');

route::post('/products', [ProductController::class, 'store'])
    ->middleware('check.usertype')
    ->name('products.store');

route::put('/products/{product}', [ProductController::class, 'update'])
    ->middleware('check.usertype')
    ->name('products.update');

route::delete('/products/{product}', [ProductController::class, 'destroy'])
    ->middleware('check.usertype')
    ->name('products.delete');

// Variantss
route::get('/variantss',[VariantsController::class,'index'])
    ->middleware('check.usertype')
    ->name('variantss.index');
route::get('/variantss/insert', [VariantsController::class, 'create'])
    ->middleware('check.usertype')
    ->name('variantss.create');

route::get('/variantss/{product}/add', [VariantsController::class, 'add'])
    ->middleware('check.usertype')
    ->name('products.add');

route::post('/variantss', [VariantsController::class, 'store'])
    ->middleware('check.usertype')
    ->name('variantss.store');

route::put('/variantss/{variant}', [VariantsController::class, 'update'])
    ->middleware('check.usertype')
    ->name('variantss.update');

route::delete('/variantss/{variant}', [VariantsController::class, 'destroy'])
    ->middleware('check.usertype')
    ->name('variantss.delete');

Route::get('/getSlug', function(Request $request){
    $slug = '';
    if (!empty($request->title)) {
        $slug = Str::slug($request->title);
    }

    return response() -> json([
        'status' => true,
        'slug' => $slug
    ]);
})->name('getSlug');

//temp
route::post('/upload-temp-image', [TempImagesController::class, 'create'])
    ->middleware('check.usertype')
    ->name('temp-images.create');



route::get('/',[HomeController::class,'index'])->name('home.index');
route::get('/profile',[HomeController::class,'profile'])->name('home.profileshow');
route::get('/categories/{type}',[HomeController::class,'categories']);
route::get('/products/{data}/{id}',[HomeController::class,'products']);
route::get('/products/{id}/{color}/{size}/{index}',[HomeController::class,'productUpdate']);
route::get('/cart',[HomeController::class,'cart']);
route::get('/checkout/{cost}',[HomeController::class,'checkout']);
route::get('/order-history',[HomeController::class,'orderHistory'])->name('user.order-histories');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

