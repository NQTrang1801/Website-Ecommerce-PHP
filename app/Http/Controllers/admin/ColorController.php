<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Color;
use function Laravel\Prompts\alert;


class colorController extends Controller
{
    public function index(Request $request)
    {
        $colors = Color::latest();

        if (!empty($request->get('keyword'))) {
            $colors = $colors->where('name', 'like', '%' . $request->get('keyword') . '%');
        }

        $colors = $colors->paginate(10);

        return view('admin.color.colors', compact('colors'));
    }

    public function create()
    {
        return view('admin.color.colors-insert');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'code' => 'required'
        ]);
        if ($validator->passes()) {
            $color = new Color();
            $color->name = $request->name;
            $color->code = $request->code;
            $color->save();

            return response()->json([
                'status' => true,
                'message' => 'color added successfully'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function edit($colorId, Request $request)
    {
        $color = Color::find($colorId);
        if (empty($color)) {
            return redirect()->route('colors.index');
        }
        return view('admin.color.colors-edit', compact('color'));
    }

    public function update($colorId, Request $request)
    {
        $color = Color::find($colorId);
        if (empty($color)) {
            return response()->json([
                'status' => false,
                'notFound' => true,
                'message' => 'color not found'
            ]);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'code' => 'required'
        ]);
        if ($validator->passes()) {
            $color->name = $request->name;
            $color->code = $request->code;
            $color->save();
            return response()->json([
                'status' => true,
                'message' => 'color updated successfully'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function destroy($colorId, Request $request)
    {
        $color = Color::find($colorId);
        if (empty($color)) {
            alert("color not found");
            return response()->json([
                'status' => false,
                'message' => 'color not found'
            ]);
        }

        $color->delete();

        return response()->json([
            'status' => true,
            'message' => 'color deleted successfully'
        ]);
    }
}
