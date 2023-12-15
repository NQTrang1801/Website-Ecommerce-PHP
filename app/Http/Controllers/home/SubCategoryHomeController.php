<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Promotion;
use App\Models\Product;
use Illuminate\Cache\RateLimiting\Limit;

class SubCategoryHomeController extends Controller
{
    public function getIsFeatured(Request $request)
    {
        $SubCategories = SubCategory::where('showHome', 'Yes')
                                ->where('is_featured', 1)->get();

        return response()->json(['featuredSubCategories' => $SubCategories]);
    }
}


?>