<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ProductsImages;
use App\Models\TempImage;
use Illuminate\Http\Request;

class TempImagesController extends Controller
{
    public function create(Request $request) {
        $image = $request->image;

        if (!empty($image))
        {
            $ext = $image->getClientOriginalExtension();
            $tempImage = new TempImage();
            $tempImage->name = 'null.png';
            $tempImage->save();
            $newName = $tempImage->id.time().'.'.$ext;
            $tempImage->name = $newName;
            $tempImage->save();
            $image->move(public_path().'/temp',$newName);

            return response()->json([
                'status' => true,
                'image_id' => $tempImage->id,
                'message' => 'image uploaded successfully'
            ]);
        }
    }
}
