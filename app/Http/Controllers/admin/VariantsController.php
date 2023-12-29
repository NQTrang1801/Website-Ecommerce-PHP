<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Promotion;
use Illuminate\Support\Facades\Validator;
use App\Models\TempImage;
use App\Models\Variants;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use function Laravel\Prompts\alert;

class VariantsController extends Controller
{
    public function index(Request $request) {
        $variantss = Variants::select(
            'variantss.*',
            'color.name as color',
            'size.name as size',
            'promotion.value as promotion_value'
            )
            ->leftJoin('color', 'variantss.color_id', '=', 'color.id')
            ->leftJoin('size', 'variantss.size_id', '=', 'size.id')
            ->leftJoin('promotion', 'variantss.promotion_id', '=', 'promotion.id')
            ->latest();
    
        if (!empty($request->get('keyword'))) {
            $keyword = $request->get('keyword');
            $variantss = $variantss->where(function ($query) use ($keyword) {
                $query->Where('variantss.id', 'like', '%' . $keyword . '%')
                    ->orWhere('variantss.product_id', 'like', '%' . $keyword . '%')
                    ->orWhere('variantss.title', 'like', '%' . $keyword . '%')
                    ;
            });
        }
    
        $variantss = $variantss->paginate(10);
    
        return view('admin.variants.variantss', compact('variantss'));
    }


    public function store(Request $request) {
        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'slug' => 'required|unique:variantss',
            'price' => 'required',
            'quantity' => 'required',
            'status' => 'required'
        ]);
        if ($validator->passes()){
            $variant = new Variants();
            $variant->title = $request->title;
            $variant->slug = $request->slug;
            $variant->price = $request->price;
            $variant->quantity = $request->quantity;
            $variant->product_id = $request->product;
            $variant->promotion_id = $request->promotion;
            $variant->color_id = $request->color;
            $variant->size_id = $request->size;
            $variant->status = $request->status;
            $variant->save();

            if (!empty($request->image)) {
                $tempImage = TempImage::find($request->image);
                $extArray = explode('.', $tempImage->name);
                $ext = last($extArray);

                $newImageName = $variant->id.'.'.$ext;
                $sPath = public_path().'/temp/'.$tempImage->name;
                $dPath = public_path().'/uploads/product/variantss/'.$newImageName;
                File::copy($sPath, $dPath);

                $dPath = public_path().'/uploads/product/variantss/thumb/'.$newImageName;
                $img = Image::make($sPath);
                $img->save($dPath);

                $variant->image = $newImageName;
                $variant->save();
            }

            return response()->json([
                'status' => true,
                'id' => $variant->id,
                'message' => 'variant added successfully'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function update($variantId, Request $request) {

        $variant = Variants::find($variantId);      

        if (empty($variant)) {
            return response()->json([
                'status' => false,
                'notFound' => true,
                'message' => 'product not found'
            ]);
        }
        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'slug' => 'required|unique:variantss,slug,'.$variant->id.',id',
            'price' => 'required',
            'quantity' => 'required',
            'status' => 'required'
        ]);

        if ($validator->passes()){
            $variant->title = $request->title;
            $variant->slug = $request->slug;
            $variant->price = $request->price;
            $variant->quantity = $request->quantity;
            $variant->product_id = $request->product;
            $variant->promotion_id = $request->promotion;
            $variant->color_id = $request->color;
            $variant->size_id = $request->size;
            $variant->status = $request->status;
            $variant->save();

            $oldImage = $variant->image;

            if (!empty($request->image)) {
                $tempImage = TempImage::find($request->image);
                $extArray = explode('.', $tempImage->name);
                $ext = last($extArray);

                $newImageName = $variant->id.'-'.time().'.'.$ext;
                $sPath = public_path().'/temp/'.$tempImage->name;
                $dPath = public_path().'/uploads/product/variantss/'.$newImageName;
                File::copy($sPath, $dPath);

                $dPath = public_path().'/uploads/product/variantss/thumb/'.$newImageName;
                $img = Image::make($sPath);
                $img->save($dPath);

                $variant->image = $newImageName;
                $variant->save();
                File::delete(public_path().'/uploads/product/variantss/thumb/'.$oldImage);
                File::delete(public_path().'/uploads/product/variantss/'.$oldImage);
            }

            return response()->json([
                'status' => true,
                'variant_id' => $variant->id,
                'message' => 'variant added successfully'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function destroy($variantId, Request $request)
    {
        $variant = Variants::find($variantId);
        if (empty($variant))
        {
            return response()->json([
                'status' => false,
                'id' => $variantId,
                'message' => 'variant not found'
            ]);
        }

        File::delete(public_path().'/uploads/product/variantss/thumb/'.$variant->image);
        File::delete(public_path().'/uploads/product/variantss/'.$variant->image);

        $variant->delete();

        return response()->json([
            'status' => true,
            'message' => 'variant deleted successfully'
        ]);
    }

    public function getVariantByColorAndSize($productId, $colorId, $sizeId)
    {
        $variant = Variants::where('product_id', $productId)
                            ->where('color_id', $colorId)
                            ->where('size_id', $sizeId)
                            ->get();

        return response()->json($variant);
    }
}
