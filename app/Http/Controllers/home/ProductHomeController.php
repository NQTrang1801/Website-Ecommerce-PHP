<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Cache\RateLimiting\Limit;

class ProductHomeController extends Controller
{
    public function getByKeyWord(Request $request)
    {
        $keyword = $request->input('keyword');
        $products = Product::where('showHome', 'Yes')
            ->whereRaw("MATCH(title, description, keywords) AGAINST(? IN BOOLEAN MODE) LIMIT 8", ["'$keyword'"])
            ->with('images')
            ->get();

        return response()->json(['getProductsByKeyWord' => $products]);
    }

    public function getIsFeatured(Request $request)
    {
        $products = Product::where('showHome', 'Yes')
                            ->where('is_featured', 1)->get();

        return response()->json(['featuredProducts' => $products]);
    }

}


?>