<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;
use App\Models\Product;
use App\Models\Promotion;
use Illuminate\Support\Facades\Validator;
use App\Models\TempImage;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use function Laravel\Prompts\alert;

class ProductController extends Controller
{
    public function index(Request $request) {
        $products = Product::select('products.*', 'categories.name as category_name', 'sub_categories.name as sub_category_name', 'promotion.value as promotion_value')
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->leftJoin('sub_categories', 'products.sub_category_id', '=', 'sub_categories.id')
            ->leftJoin('promotion', 'products.promotion_id', '=', 'promotion.id')
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
        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'slug' => 'required|unique:products',
            'price' => 'required',
            'amount' => 'required',
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
            $product->sub_category_id = $request->sub_category;
            $product->promotion_id = $request->promotion;
            $product->save();

            return response()->json([
                'status' => true,
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
        // $product = SubCategory::find($productId);

        // $products = Category::orderBy('name', 'ASC')->get();
        // $data['subCategory']=$product;
        // $data['categories']= $products;

        // if (empty($product)) {
        //     return redirect()->route('sub-categories.index');
        // }
        // return view('admin.sub_category.sub-categories-edit', $data);
    }

    public function update($productId, Request $request) {
        // $product = SubCategory::find($productId);
        

        // if (empty($product)) {
        //     return response()->json([
        //         'status' => false,
        //         'notFound' => true,
        //         'message' => 'sub category not found'
        //     ]);
        // }

        // $validator = Validator::make($request->all(),[
        //     'name' => 'required',
        //     'slug' => 'required|unique:categories,slug,'.$product->id.',id',
        //     'category' => 'required',
        //     'status' => 'required'
        // ]);
        // if ($validator->passes()){
        //     $product->name = $request->name;
        //     $product->slug = $request->slug;
        //     $product->status = $request->status;
        //     $product->category_id = $request->category;
        //     $product->save();

        //     $oldImage = $product->image;

        //     if (!empty($request->image_id)) {
        //         $tempImage = TempImage::find($request->image_id);
        //         $extArray = explode('.', $tempImage->name);
        //         $ext = last($extArray);

        //         $newImageName = $product->id.'-'.time().'.'.$ext;
        //         $sPath = public_path().'/temp/'.$tempImage->name;
        //         $dPath = public_path().'/uploads/sub category/'.$newImageName;
        //         File::copy($sPath, $dPath);

        //         $dPath = public_path().'/uploads/sub category/thumb/'.$newImageName;
        //         $img = Image::make($sPath);
        //         $img->resize(600, 600);
        //         $img->save($dPath);

        //         $product->image = $newImageName;
        //         $product->save();

        //         File::delete(public_path().'/uploads/sub category/thumb/'.$oldImage);
        //         File::delete(public_path().'/uploads/sub category/'.$oldImage);

        //     }

        //     return response()->json([
        //         'status' => true,
        //         'message' => 'sub Category added successfully'
        //     ]);
        // } else {
        //     return response()->json([
        //         'status' => false,
        //         'errors' => $validator->errors()
        //     ]);
        // }
    }
    public function destroy($productId, Request $request)
    {
        // $product = SubCategory::find($productId);
        // if (empty($product))
        // {
        //     alert("sub category not found");
        //     return response()->json([
        //         'status' => false,
        //         'message' => 'sub category not found'
        //     ]);
        // }

        // File::delete(public_path().'/uploads/sub category/thumb/'.$product->image);
        // File::delete(public_path().'/uploads/sub category/'.$product->image);

        // $product->delete();

        // return response()->json([
        //     'status' => true,
        //     'message' => 'sub Category deleted successfully'
        // ]);
    }
}
