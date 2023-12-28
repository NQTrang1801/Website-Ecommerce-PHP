<?php

use App\Models\Category;
use App\Models\SubCategory;

function getCategories()
{
    return Category::orderBy('name', 'ASC')
        ->with('getSubCategories')
        ->where('status', 1)
        ->where('showHome', 'Yes')
        ->get();
}

function getIsFeaturedCategories()
{
    return Category::where('showHome', 'Yes')
                    ->where('is_featured', 1)->get();
}

function getIsFeaturedSubCategory()
{
    return SubCategory::where('showHome', 'Yes')
                                ->where('is_featured', 1)->get();

}

function getProductByPromotionAndCategory()
{

}

?>