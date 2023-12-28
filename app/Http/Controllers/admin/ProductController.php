<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;
use App\Models\Product;
use App\Models\Promotion;
use App\Models\Size;
use App\Models\Color;
use App\Models\Variants;
use App\Models\ProductsImages;
use Illuminate\Support\Facades\Validator;
use App\Models\TempImage;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use function Laravel\Prompts\alert;

class ProductController extends Controller
{
    public function index(Request $request) {
        $products = Product::select(
            'products.*',
            'categories.name as category_name',
            'sub_categories.name as subCategory_name',
            'promotion.value as promotion_value',
            'products_images.image_1 as image_1',
            'products_images.image_2 as image_2',
            'products_images.image_3 as image_3',
            'products_images.image_4 as image_4'
            )
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->leftJoin('sub_categories', 'products.sub_category_id', '=', 'sub_categories.id')
            ->leftJoin('promotion', 'products.promotion_id', '=', 'promotion.id')
            ->leftJoin('products_images', 'products.images_id', '=', 'products_images.id')
            ->latest();
    
        if (!empty($request->get('keyword'))) {
            $keyword = $request->get('keyword');
            $products = $products->where(function ($query) use ($keyword) {
                $query->where('keywords', 'like', '%' . $keyword . '%')
                    ->orWhere('title', 'like', '%' . $keyword . '%');
            });
        }
    
        $products = $products->paginate(10);
    
        return view('admin.product.products', compact('products'));
    }

    public function create()
    {
        $categories = Category::orderBy('name', 'ASC')->get();
        $subCategories = SubCategory::orderBy('name', 'ASC')->get();
        $promotion = Promotion::where('status', 1)->orderBy('created_at', 'DESC')->get();
        $data['categories']=$categories;
        $data['subCategories']=$subCategories;
        $data['promotion']=$promotion;
        return view('admin.product.products-insert', $data);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'slug' => 'required|unique:products',
            'price' => 'required|numeric|min:0',
            'amount' => 'required|numeric|min:0',
            'status' => 'required'
        ]);
    
        if ($validator->passes()){
            $product = new Product();
            $product->title = $request->title;
            $product->slug = $request->slug;
            $product->price = $request->price;
            $product->amount = $request->amount;
            $product->detail = $request->detail;
            $product->care = $request->care;
            $product->description = $request->description;
            $product->keywords = $request->keywords;
            $product->status = $request->status;
            $product->category_id = $request->category;
            $product->sub_category_id = $request->subCategory;
            $product->promotion_id = $request->promotion;
            $product->save();
            $productImage = new ProductsImages();
            $productImage->image_1 = "null.png";
            $productImage->save();
            $product->images_id = $productImage->id;
            $product->save();
    
            $imageFields = ['image_1', 'image_2', 'image_3', 'image_4'];
    
            foreach ($imageFields as $field) {
                $image = $request->input($field);
    
                if (!empty($image) && $image != "0") {
                    $tempImage = TempImage::find($image);
                    $extArray = explode('.', $tempImage->name);
                    $ext = last($extArray);
    
                    $newImageName = $product->id . '-' . substr($field, -1) . '.' . $ext;
                    $sPath = public_path().'/temp/'.$tempImage->name;
                    $dPath = public_path().'/uploads/product/products/products images/'.$newImageName;
                    File::copy($sPath, $dPath);
    
                    $dPath = public_path().'/uploads/product/products/thumb/'.$newImageName;
                    $img = Image::make($sPath);
                    $img->save($dPath);
    
                    $productImage->$field = $newImageName;
                    $productImage->save();
                }
            }
    
            return response()->json([
                'status' => true,
                'productId' => $product->id,
                'message' => 'product added successfully'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }
    

    public function edit($productId, Request $request) {
        $product = Product::select(
            'products.*', 
            'products_images.image_1 as image_1', 
            'products_images.image_2 as image_2', 
            'products_images.image_3 as image_3', 
            'products_images.image_4 as image_4'
            )
            ->leftJoin('products_images', 'products.images_id', '=', 'products_images.id')
            ->where('products.id', $productId)
            ->first();

        $variantss = Variants::select(
                'variantss.*',
                'color.name as color',
                'size.name as size',
                'promotion.value as promotion_value'
            )
                ->leftJoin('color', 'variantss.color_id', '=', 'color.id')
                ->leftJoin('size', 'variantss.size_id', '=', 'size.id')
                ->leftJoin('promotion', 'variantss.promotion_id', '=', 'promotion.id')
                ->where('variantss.product_id', $productId)
                ->latest()
                ->get();

        $categories = Category::orderBy('name', 'ASC')->get();
        $subCategories = SubCategory::orderBy('name', 'ASC')->get();
        $promotion = Promotion::where('status', 1)->orderBy('created_at', 'DESC')->get();
        $sizes = Size::orderBy('name', 'ASC')->get();
        $colors = Color::orderBy('name', 'ASC')->get();
        $data['product']=$product;
        $data['categories']=$categories;
        $data['subCategories']=$subCategories;
        $data['promotion']=$promotion;
        $data['sizes']=$sizes;
        $data['colors']=$colors;
        $data['variantss']=$variantss;

        if (empty($product)) {
            return redirect()->route('products.index');
        }
        return view('admin.product.products-edit', $data);
    }

    public function update($productId, Request $request) {
        $product = Product::find($productId);
    
        if (empty($product)) {
            return response()->json([
                'status' => false,
                'notFound' => true,
                'message' => 'product not found'
            ]);
        }
    
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'slug' => 'required|unique:products,slug,' . $product->id . ',id',
            'price' => 'required',
            'amount' => 'required',
            'status' => 'required'
        ]);
    
        if ($validator->passes()) {
            $this->updateProductAttributes($product, $request);
    
            if (!empty($request->image_1)) {
                $productImage = $this->updateProductImages($product, $request);
                $this->processImage($request->image_2, $productImage, 2);
                $this->processImage($request->image_3, $productImage, 3);
                $this->processImage($request->image_4, $productImage, 4);
            }
    
            return response()->json([
                'status' => true,
                'message' => 'product updated successfully'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }
    
    private function updateProductAttributes($product, $request) {
        $product->title = $request->title;
        $product->slug = $request->slug;
        $product->price = $request->price;
        $product->amount = $request->amount;
        $product->detail = $request->detail;
        $product->care = $request->care;
        $product->description = $request->description;
        $product->keywords = $request->keywords;
        $product->status = $request->status;
    
        if ($request->status == 0) {
            $product->showHome = "No";
            $product->is_featured = 0;
        }
    
        $product->category_id = $request->category;
        $product->sub_category_id = $request->subCategory;
        $product->promotion_id = $request->promotion;
    
        $product->save();
    }
    
    private function updateProductImages($product, $request) {
        $productImage = ProductsImages::find($product->images_id);
        if (empty($productImage)) {
            $productImage = new ProductsImages();
        }
    
        $tempImage = TempImage::find($request->image_1);
        $oldImage = $productImage->image_1;
        $extArray = explode('.', $tempImage->name);
        $ext = last($extArray);
    
        $newImageName = $product->id . '-1-' . time() . '.' . $ext;
        $sPath = public_path() . '/temp/' . $tempImage->name;
        $dPath = public_path() . '/uploads/product/products/products images/' . $newImageName;
        File::copy($sPath, $dPath);
    
        $dPath = public_path() . '/uploads/product/products/thumb/' . $newImageName;
        $img = Image::make($sPath);
        $img->save($dPath);
        $productImage->image_1 = $newImageName;
        $productImage->save();
        $product->images_id = $productImage->id;
        $product->save();
    
        File::delete(public_path() . '/uploads/product/products/thumb/' . $oldImage);
        File::delete(public_path() . '/uploads/product/products/products images/' . $oldImage);
    
        return $productImage;
    }
    
    private function processImage($imageId, $productImage, $number) {
        if (!empty($imageId)) {
            $tempImage = TempImage::find($imageId);
            $oldImage = $productImage->{'image_' . $number};
            $extArray = explode('.', $tempImage->name);
            $ext = last($extArray);
    
            $newImageName = $productImage->product_id . '-' . $number . '-' . time() . '.' . $ext;
            $sPath = public_path() . '/temp/' . $tempImage->name;
            $dPath = public_path() . '/uploads/product/products/products images/' . $newImageName;
            File::copy($sPath, $dPath);
    
            $dPath = public_path() . '/uploads/product/products/thumb/' . $newImageName;
            $img = Image::make($sPath);
            $img->save($dPath);
    
            $productImage->{'image_' . $number} = $newImageName;
            $productImage->save();
    
            File::delete(public_path() . '/uploads/product/products/thumb/' . $oldImage);
            File::delete(public_path() . '/uploads/product/products/products images/' . $oldImage);
        }
    }
    

    public function showHome($productId, Request $request) {
        $product = Product::find($productId);
        if (empty($product)) {
            return response()->json([
                'status' => false,
                'notFound' => true,
                'message' => 'Product not found'
            ]);
        }

        $newShowHomeValue = $request->input('showHome');

        $product->showHome = $newShowHomeValue;
        $product->save();

        return response()->json([
            'status' => true,
            'message' => 'ShowHome updated successfully'
        ]);
    }

    public function isFeatured($productId, Request $request) {
        $product = Product::find($productId);
        if (empty($product)) {
            return response()->json([
                'status' => false,
                'notFound' => true,
                'message' => 'Category not found'
            ]);
        }

        $newFeaturedValue = $request->input('isFeatured');

        $product->is_featured = $newFeaturedValue;
        $product->save();

        return response()->json([
            'status' => true,
            'message' => 'Featured updated successfully'
        ]);
    }

    public function destroy($productId, Request $request)
    {
        $product = Product::find($productId);
        $productImage = ProductsImages::find($product->images_id);
        if (empty($product))
        {
            alert("product not found");
            return response()->json([
                'status' => false,
                'message' => 'product not found'
            ]);
        }

        $product->delete();

        if (!empty($productImage))
        {
            if (!empty($productImage->image_1))
            {
                File::delete(public_path().'/uploads/product/products/thumb/'.$productImage->image_1);
                File::delete(public_path().'/uploads/product/products/products images/'.$productImage->image_1);
            }

            if (!empty($productImage->image_2))
            {
                File::delete(public_path().'/uploads/product/products/thumb/'.$productImage->image_2);
                File::delete(public_path().'/uploads/product/products/products images/'.$productImage->image_2);
            }

            if (!empty($productImage->image_3))
            {
                File::delete(public_path().'/uploads/product/products/thumb/'.$productImage->image_3);
                File::delete(public_path().'/uploads/product/products/products images/'.$productImage->image_3);
            }

            if (!empty($productImage->image_4))
            {
                File::delete(public_path().'/uploads/product/products/thumb/'.$productImage->image_4);
                File::delete(public_path().'/uploads/product/products/products images/'.$productImage->image_4);
            }
        }

        $productImage->delete();
        

        return response()->json([
            'status' => true,
            'message' => 'product deleted successfully'
        ]);
    }


}
