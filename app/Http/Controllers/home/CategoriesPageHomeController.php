<?php


namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Cache\RateLimiting\Limit;

class CategoriesPageHomeController extends Controller
{
    public function index($keySearch) {
        $categoryResults = Category::where('name', $keySearch)->limit(1)->get();
        $data = [];
        $products = [];
        $subCategoryResults = [];
        if ($categoryResults->isEmpty()) {
            $subCategoryResults = SubCategory::where('name', $keySearch)->limit(1)->get();
            if (!$subCategoryResults->isEmpty()) {
                $productResults = Product::where('sub_category_id', $subCategoryResults[0]->id)->get();
                array_push($products, $productResults);
            }
        } else {
                foreach($categoryResults[0]->getSubCategories as $sub)
                {
                    $productResults = Product::with('images')
                                    ->with('promotion')
                                    ->with('category')
                                    ->with('subCategory')
                                    ->where('category_id', $categoryResults[0]->id)
                                    ->orWhere('sub_category_id', $sub->id)->get();
                    array_push($products, $productResults);
                }
        }
        $data['subCategory']=$subCategoryResults;
        $data['products'] = $products;
        $data['category']=$categoryResults;
        return view('home.product.categories', $data);
    }
}


?>