<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Size;
use function Laravel\Prompts\alert;


class SizeController extends Controller
{
    public function index(Request $request)
    {
        $sizes = Size::latest();

        if (!empty($request->get('keyword'))) {
            $sizes = $sizes->where('name', 'like', '%' . $request->get('keyword') . '%');
        }

        $sizes = $sizes->paginate(10);

        return view('admin.size.sizes', compact('sizes'));
    }

    public function create()
    {
        return view('admin.size.sizes-insert');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);
        if ($validator->passes()) {
            $size = new Size();
            $size->name = $request->name;
            $size->save();

            return response()->json([
                'status' => true,
                'message' => 'size added successfully'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function edit($sizeId, Request $request)
    {
        $size = Size::find($sizeId);
        if (empty($size)) {
            return redirect()->route('sizes.index');
        }
        return view('admin.size.sizes-edit', compact('size'));
    }

    public function update($sizeId, Request $request)
    {
        $size = Size::find($sizeId);
        if (empty($size)) {
            return response()->json([
                'status' => false,
                'notFound' => true,
                'message' => 'size not found'
            ]);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);
        if ($validator->passes()) {
            $size->name = $request->name;
            $size->save();
            return response()->json([
                'status' => true,
                'message' => 'size updated successfully'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function destroy($sizeId, Request $request)
    {
        $size = Size::find($sizeId);
        if (empty($size)) {
            alert("size not found");
            return response()->json([
                'status' => false,
                'message' => 'size not found'
            ]);
        }

        $size->delete();

        return response()->json([
            'status' => true,
            'message' => 'size deleted successfully'
        ]);
    }
}
