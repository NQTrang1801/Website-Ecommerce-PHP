<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;
use App\Models\Product;
use App\Models\Promotion;
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
            'products.*', 'promotion.value as promotion_value',
            'products_images.image_1 as image_1',
            'products_images.image_2 as image_2',
            'products_images.image_3 as image_3',
            'products_images.image_4 as image_4'
            )
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
            $product->sub_category_id = $request->subCategory;
            $product->promotion_id = $request->promotion;
            $product->save();

            if (!empty($request->image_1)) {
                $tempImage = TempImage::find($request->image_1);
                $productImage= new ProductsImages();
                $extArray = explode('.', $tempImage->name);
                
                $ext = last($extArray);

                $newImageName = $product->id.'-1.'.$ext;
                $sPath = public_path().'/temp/'.$tempImage->name;
                $dPath = public_path().'/uploads/product/products/products images/'.$newImageName;
                File::copy($sPath, $dPath);

                $dPath = public_path().'/uploads/product/products/thumb/'.$newImageName;
                $img = Image::make($sPath);
                $img->save($dPath);

                $productImage->image_1 = $newImageName;
                $productImage->save();
                $product->images_id = $productImage->id;
                $product->save();

                if (!empty($request->image_2)) {
                    $tempImage2 = TempImage::find($request->image_2);
                    $extArray = explode('.', $tempImage2->name);
                    
                    $ext = last($extArray);
    
                    $newImageName2 = $product->id.'-2.'.$ext;
                    $sPath = public_path().'/temp/'.$tempImage2->name;
                    $dPath = public_path().'/uploads/product/products/products images/'.$newImageName2;
                    File::copy($sPath, $dPath);
    
                    $dPath = public_path().'/uploads/product/products/thumb/'.$newImageName2;
                    $img = Image::make($sPath);
                    $img->save($dPath);
    
                    $productImage->image_2 = $newImageName2;
                    $productImage->save();
                }

                if (!empty($request->image_3)) {
                    $tempImage3 = TempImage::find($request->image_3);
                    $extArray = explode('.', $tempImage3->name);
                    
                    $ext = last($extArray);
    
                    $newImageName3 = $product->id.'-3.'.$ext;
                    $sPath = public_path().'/temp/'.$tempImage3->name;
                    $dPath = public_path().'/uploads/product/products/products images/'.$newImageName3;
                    File::copy($sPath, $dPath);
    
                    $dPath = public_path().'/uploads/product/products/thumb/'.$newImageName3;
                    $img = Image::make($sPath);
                    $img->save($dPath);
    
                    $productImage->image_3 = $newImageName3;
                    $productImage->save();
                }

                if (!empty($request->image_4)) {
                    $tempImage4 = TempImage::find($request->image_4);
                    $extArray = explode('.', $tempImage4->name);
                    
                    $ext = last($extArray);
    
                    $newImageName4 = $product->id.'-4.'.$ext;
                    $sPath = public_path().'/temp/'.$tempImage4->name;
                    $dPath = public_path().'/uploads/product/products/products images/'.$newImageName4;
                    File::copy($sPath, $dPath);
    
                    $dPath = public_path().'/uploads/product/products/thumb/'.$newImageName4;
                    $img = Image::make($sPath);
                    $img->save($dPath);
    
                    $productImage->image_4 = $newImageName4;
                    $productImage->save();
                }
            }

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

        $categories = Category::orderBy('name', 'ASC')->get();
        $subCategories = SubCategory::orderBy('name', 'ASC')->get();
        $promotion = Promotion::where('status', 1)->orderBy('created_at', 'DESC')->get();
        $data['product']=$product;
        $data['categories']=$categories;
        $data['subCategories']=$subCategories;
        $data['promotion']=$promotion;

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

        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'slug' => 'required|unique:products,slug,'.$product->id.',id',
            'price' => 'required',
            'amount' => 'required',
            'status' => 'required'
        ]);

        if ($validator->passes()){
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

            if (!empty($request->image_1)) {
                $tempImage = TempImage::find($request->image_1);
                $productImage = ProductsImages::find($product->images_id);
                if (empty($productImage))
                {
                    $productImage = new ProductsImages();
                }

                $oldImage = $productImage->image_1;
                $extArray = explode('.', $tempImage->name);
                $ext = last($extArray);

                $newImageName =$product->id.'-1-'.time().'.'.$ext;
                $sPath = public_path().'/temp/'.$tempImage->name;
                $dPath = public_path().'/uploads/product/products/products images/'.$newImageName;
                File::copy($sPath, $dPath);

                $dPath = public_path().'/uploads/product/products/thumb/'.$newImageName;
                $img = Image::make($sPath);
                $img->save($dPath);
                $productImage->image_1 = $newImageName;
                $productImage->save();
                $product->images_id = $productImage->id;
                $product->save();

                File::delete(public_path().'/uploads/product/products/thumb/'.$oldImage);
                File::delete(public_path().'/uploads/product/products/products images/'.$oldImage);

                if (!empty($request->image_2)) {
                    $tempImage2 = TempImage::find($request->image_2);
                    $oldImage = $productImage->image_2;
                    $extArray = explode('.', $tempImage2->name);
                    $ext = last($extArray);

                    $newImageName = $product->id.'-2-'.time().'.'.$ext;
                    $sPath = public_path().'/temp/'.$tempImage2->name;
                    $dPath = public_path().'/uploads/product/products/products images/'.$newImageName;
                    File::copy($sPath, $dPath);

                    $dPath = public_path().'/uploads/product/products/thumb/'.$newImageName;
                    $img = Image::make($sPath);
                    $img->save($dPath);

                    $productImage->image_2 = $newImageName;
                    $productImage->save();

                    File::delete(public_path().'/uploads/product/products/thumb/'.$oldImage);
                    File::delete(public_path().'/uploads/product/products/products images/'.$oldImage);
                }

                if (!empty($request->image_3)) {
                    $tempImage3 = TempImage::find($request->image_3);
                    $oldImage = $productImage->image_3;
                    $extArray = explode('.', $tempImage3->name);
                    $ext = last($extArray);

                    $newImageName = $product->id.'-3-'.time().'.'.$ext;
                    $sPath = public_path().'/temp/'.$tempImage3->name;
                    $dPath = public_path().'/uploads/product/products/products images/'.$newImageName;
                    File::copy($sPath, $dPath);

                    $dPath = public_path().'/uploads/product/products/thumb/'.$newImageName;
                    $img = Image::make($sPath);
                    $img->save($dPath);

                    $productImage->image_3 = $newImageName;
                    $productImage->save();

                    File::delete(public_path().'/uploads/product/products/thumb/'.$oldImage);
                    File::delete(public_path().'/uploads/product/products/products images/'.$oldImage);
                }

                if (!empty($request->image_4)) {
                    $tempImage4 = TempImage::find($request->image_4);
                    $oldImage = $productImage->image_4;
                    $extArray = explode('.', $tempImage4->name);
                    $ext = last($extArray);

                    $newImageName = $product->id.'-4-'.time().'.'.$ext;
                    $sPath = public_path().'/temp/'.$tempImage4->name;
                    $dPath = public_path().'/uploads/product/products/products images/'.$newImageName;
                    File::copy($sPath, $dPath);

                    $dPath = public_path().'/uploads/product/products/thumb/'.$newImageName;
                    $img = Image::make($sPath);
                    $img->save($dPath);

                    $productImage->image_4 = $newImageName;
                    $productImage->save();

                    File::delete(public_path().'/uploads/product/products/thumb/'.$oldImage);
                    File::delete(public_path().'/uploads/product/products/products images/'.$oldImage);
                }
            }

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
