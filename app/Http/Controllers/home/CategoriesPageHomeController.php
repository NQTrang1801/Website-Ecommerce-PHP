<?php
namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;
use App\Models\Product;

class CategoriesPageHomeController extends Controller
{
    public function index($type, $key = null)
    {
        $category = Category::where('slug', $type)->with('getSubCategories')->first();
        $subCategoryResults = [];
        if ($category != null)
        {
            $cate_id = $category->id;
            foreach ($category->getSubCategories as $sub) {
                $sub->load(['products' => function ($query) use ($cate_id) {
                    $query->where('showHome', 'Yes')->where('category_id', $cate_id);
                }]);
            
                if ($sub->products->isNotEmpty()) {
                    $subCategoryResults[] = $sub;
                }
            }  
        }  

        $specialPrices = Product::with('images', 'promotion', 'category', 'subCategory')
                ->where('showHome', 'Yes')
                ->whereHas('Category', function ($query) use ($type) {
                    $query->where('slug', $type)
                          ->where('showHome', 'Yes');
                })
                ->whereHas('promotion', function ($query) {
                    $query->whereNotNull('promotion_id');
                })
                ->paginate(8);

        $productFeatureds = Product::where('showHome', 'Yes')
                ->where('is_featured', 1)
                ->with('images')
                ->take(4)
                ->get();

        $data['specialPrices'] = $specialPrices;     
        $data['subCategory'] = $subCategoryResults;
        $data['category'] = $category;
        $data['productFeatureds'] = $productFeatureds;
        return view('home.product.categories', $data);
    }
}

?>

