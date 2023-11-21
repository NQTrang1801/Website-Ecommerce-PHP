<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\CategoryController;

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

route::post('/categories', [CategoryController::class, 'store'])
    ->middleware('check.usertype')
    ->name('categories.store');


route::get('/',[HomeController::class,'index']);
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

