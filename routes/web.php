<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\TempImagesController;
use Illuminate\Http\Request;
use Illuminate\Support\Str; // Thêm dòng này để import lớp Str

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

route::delete('/categories/{category}', [CategoryController::class, 'destroy'])
    ->middleware('check.usertype')
    ->name('categories.delete');

route::post('/categories', [CategoryController::class, 'store'])
    ->middleware('check.usertype')
    ->name('categories.store');



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

route::post('/upload-temp-image', [TempImagesController::class, 'create'])
    ->middleware('check.usertype')
    ->name('temp-images.create');


route::get('/',[HomeController::class,'index'])->name('home.index');
route::get('/categories/{type}',[HomeController::class,'categories']);
route::get('/products/{data}/{id}',[HomeController::class,'products']);
route::get('/products/{id}/{color}/{size}/{index}',[HomeController::class,'productUpdate']);
route::get('/cart',[HomeController::class,'cart']);
route::get('/checkout/{cost}',[HomeController::class,'checkout']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

