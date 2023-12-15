<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function promotion()
    {
        return $this->belongsTo(Promotion::class);
    }

    public function images()
    {
        return $this->belongsTo(ProductsImages::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subCategory()
    {
        return $this->belongsTo(subCategory::class);
    }
}
