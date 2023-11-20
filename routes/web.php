<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

route::get('/redirect',[HomeController::class,'redirect']);
