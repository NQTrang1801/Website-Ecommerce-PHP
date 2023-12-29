<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Promotion;
use function Laravel\Prompts\alert;


class PromotionController extends Controller
{
    public function index(Request $request)
    {
        $promotions = Promotion::latest();

        if (!empty($request->get('keyword'))) {
            $keyword = $request->get('keyword');
            $promotions = $promotions->where(function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%')
                    ->orWhere('code', 'like', '%' . $keyword . '%')
                    ->orWhere('expiration_date', 'like', '%' . $keyword . '%');
            });
        }

        $promotions = $promotions->paginate(10);

        return view('admin.promotion.promotions', compact('promotions'));
    }

    public function create()
    {
        return view('admin.promotion.promotions-insert');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required|unique:promotion',
            'value' => 'required',
            'code' => 'required',
            'expiration_date' => 'required'
        ]);
        if ($validator->passes()) {
            $promotion = new Promotion();
            $promotion->name = $request->name;
            $promotion->slug = $request->slug;
            $promotion->value = $request->value;
            $promotion->code = $request->code;
            $promotion->expiration_date = $request->expiration_date;
            $promotion->status = $request->status;
            $promotion->save();

            return response()->json([
                'status' => true,
                'message' => 'promotion added successfully'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function edit($promotionId, Request $request)
    {
        $promotion = Promotion::find($promotionId);
        if (empty($promotion)) {
            return redirect()->route('promotions.index');
        }
        return view('admin.promotion.promotions-edit', compact('promotion'));
    }

    public function update($promotionId, Request $request)
    {
        $promotion = Promotion::find($promotionId);
        if (empty($promotion)) {
            return response()->json([
                'status' => false,
                'notFound' => true,
                'message' => 'promotion not found'
            ]);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required|unique:promotion,slug,' . $promotion->id . ',id',
            'value' => 'required',
            'code' => 'required',
            'expiration_date' => 'required'
        ]);

        if ($validator->passes()) {
            $promotion->name = $request->name;
            $promotion->slug = $request->slug;
            $promotion->value = $request->value;
            $promotion->code = $request->code;
            $promotion->expiration_date = $request->expiration_date;
            $promotion->status = $request->status;
            $promotion->save();
            return response()->json([
                'status' => true,
                'message' => 'promotion updated successfully'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function destroy($promotionId, Request $request)
    {
        $promotion = Promotion::find($promotionId);
        if (empty($promotion)) {
            alert("promotion not found");
            return response()->json([
                'status' => false,
                'message' => 'promotion not found'
            ]);
        }

        $promotion->delete();

        return response()->json([
            'status' => true,
            'message' => 'promotion deleted successfully'
        ]);
    }
}
