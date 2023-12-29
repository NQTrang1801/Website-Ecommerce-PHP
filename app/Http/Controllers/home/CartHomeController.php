<?php
namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Variants;

class CartHomeController extends Controller
{
    public function addToCartDefault(Request $request)
    {
        try {
            $productId = $request->productId;
            $colorId = $request->colorId;
            $sizeId = $request->sizeId;

            $variantDetails = Variants::where('product_id', $productId)
                ->where('status', 1);

            if ($colorId != null && $sizeId != null) {
                $variantDetails->where('color_id', $colorId)
                                ->where('size_id', $sizeId);
            }

            $variantDetails = $variantDetails->first();

            if ($variantDetails) {
                $colorName = optional($variantDetails->color)->name;
                $sizeName = optional($variantDetails->size)->name;
                $promoValue = optional($variantDetails->promotion)->value;

                return response()->json([
                    'success' => true,
                    'message' => 'Success add to cart.',
                    'variant' => $variantDetails,
                    'color' => $colorName,
                    'size' => $sizeName,
                    'promotion' => $promoValue
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Product not found.'
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while processing your request.'
            ]);
        }
    }

}

?>

