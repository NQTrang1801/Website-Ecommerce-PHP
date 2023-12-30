<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Cache\RateLimiting\Limit;

class CheckOutPageHomeController extends Controller
{
    public function index($cost) {               

        return view('home.checkout.checkout', compact('cost'));
    }
}
