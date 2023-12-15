<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Cache\RateLimiting\Limit;

class CategoryHomeController extends Controller
{
    public function getIsFeatured(Request $request)
    {
        $categories = Category::where('showHome', 'Yes')
                            ->where('is_featured', 1)->limit(4)->get();

        return response()->json(['featuredCategories' => $categories]);
    }
}


?>