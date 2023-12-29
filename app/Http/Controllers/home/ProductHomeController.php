<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;
use App\Models\Product;
use App\Models\Size;
use App\Models\Variants;
use Illuminate\Cache\RateLimiting\Limit;

class ProductHomeController extends Controller
{
    public function index($productId)
    {
        $product = Product::with(['Category', 'Images', 'Promotion', 'SubCategory'])
            ->where('id', $productId)
            ->where('ShowHome', 'Yes')
            ->first();

        if (!$product) {
            return abort(404);
        }

        $variantss = Variants::with(['Size', 'Color'])
            ->where('product_id', $productId)
            ->where('Status', 1)
            ->get();

        $distinctColors = $variantss->groupBy('ColorId')
            ->map(function ($item) {
                return $item->first();
            })->values();

        return view('home.product detail.products-detail', compact('variantss', 'product', 'distinctColors'));
    }

    public function updateCart(Request $request)
    {
        $indexCart = $request->input('indexCart');
        $productId = $request->input('productId');

        $product = Product::with(['Category', 'Images', 'Promotion', 'SubCategory'])
            ->where('id', $productId)
            ->where('ShowHome', 'Yes')
            ->first();

        if (!$product) {
            return abort(404);
        }

        $variantss = Variants::with(['Size', 'Color'])
            ->where('product_id', $productId)
            ->where('Status', 1)
            ->get();

        $distinctColors = $variantss->groupBy('ColorId')
            ->map(function ($item) {
                return $item->first();
            })->values();

        return view('home.product detail.products-detail', compact('variantss', 'product', 'distinctColors', 'indexCart'));
    }

    public function getSizesByColor($productId, $colorId)
    {
        $variants = Variants::where('product_id', $productId)
                        ->where('status', '1')
                        ->where('color_id', $colorId)
                        ->get();

        $sizes = $variants->unique('size_id')->pluck('size_id');

        $sizeDetails = Size::whereIn('id', $sizes)->get();

        return response()->json([
            'success' => true,
            'sizes' => $sizeDetails
        ]);
    }

    
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