<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Cache\RateLimiting\Limit;

class IndexPageHomeController extends Controller
{
    public function index() {
        $productsSale = Product::where('showHome', 'Yes')
                            ->where('is_featured', 1)
                            ->whereNotNull('promotion_id')
                            ->with('promotion')
                            ->with('images')
                            ->get();                   

        return view('home.index.index', compact('productsSale'));
    }
}
