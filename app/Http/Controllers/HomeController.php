<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Users;

class HomeController extends Controller
{
    public function index() 
    {
        return view('home.index');
    }
    
    public function categories($type)
    {
        return view('home.categories');
    }

    public function products($data, $id)
    {
        return view('home.products-detail');
    }

    public function productUpdate($id, $color, $size, $index)
    {
        return view('home.products-detail');
    }

    public function cart()
    {
        return view('home.cart');
    }

    public function checkout($cost)
    {
        return view('home.checkout');
    }

    public function orderHistory()
    {
        return view('home.order-histories');
    }

    public function redirect()
    {
        $usertype = Auth::user()->usertype;
        if ($usertype == '1')
        {
            return view('admin.home');
        }
        else
        {
            return view('home.index');
        }
    }
}
