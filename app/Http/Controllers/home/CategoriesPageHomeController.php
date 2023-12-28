<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;
use App\Models\Product;

class CategoriesPageHomeController extends Controller
{
    public function index($cateType, $subType = null) {
        $category = Category::where('slug', $cateType)->with('getSubCategories')->first();
        $subCategoryResults = [];
        $products = [];
        
        
        if ($category === null) {
            $subCategory = SubCategory::where('slug', $cateType)->first();
            if ($subCategory !== null) {
                $products = Product::with('images', 'promotion', 'category', 'subCategory')
                    ->where('sub_category_id', $subCategory->id)->get();
            }
        } else {
            foreach ($category->getSubCategories as $sub) {
                $productResults = Product::with('images', 'promotion', 'category', 'subCategory')
                    ->where(function ($query) use ($category, $sub) {
                        $query->where('category_id', $category->id)
                            ->orWhere('sub_category_id', $sub->id);
                    })
                    ->get();
                $products[] = $productResults;
            }
        }

        $productIds = collect($products)->flatten()->pluck('id')->toArray();

        // Lọc danh sách sản phẩm có giá đặc biệt từ danh sách ID đã lấy
        $specialPrices = Product::with('images', 'promotion', 'category', 'subCategory')
            ->whereIn('id', $productIds)
            ->whereHas('promotion', function ($query) {
                $query->whereNotNull('promotion_id');
            })
            ->get();

        $data['specialPrices'] = $specialPrices;
        $data['subCategory'] = $subCategoryResults;
        $data['products'] = $products;
        $data['category'] = $category;   
        return view('home.product.categories', $data);
    }
}
?>
