<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Users;

class HomeController extends Controller
{
    public function index() 
    {
        return view('home.index.index');
    }
    
    public function categories($type)
    {
        return view('home.product.categories');
    }

    public function cart()
    {
        return view('home.cart.cart');
    }

    public function checkout($cost)
    {
        return view('home.checkout.checkout');
    }

    public function orderHistory()
    {
        return view('home.order history.order-histories');
    }

    public function services()
    {
        return view('home.service.service');
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
            return view('home.index.index');
        }
    }
}
