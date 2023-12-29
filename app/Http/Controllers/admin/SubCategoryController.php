<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use App\Models\TempImage;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use function Laravel\Prompts\alert;

class SubCategoryController extends Controller
{
    public function index(Request $request)
    {
        $subCategories = SubCategory::select(
            'sub_categories.*',
            'categories.name as category_name',
        )
            ->leftJoin('categories', 'sub_categories.category_id', '=', 'categories.id')
            ->latest();

        if (!empty($request->get('keyword'))) {
            $subCategories = $subCategories->where('sub_categories.name', 'like', '%' . $request->get('keyword') . '%')
                ->orWhere('categories.name', 'like', '%' . $request->get('keyword') . '%');
        }

        $subCategories = $subCategories->paginate(10);

        return view('admin.sub_category.sub-categories', compact('subCategories'));
    }

    public function create()
    {
        $categories = Category::orderBy('name', 'ASC')->get();
        $data['categories'] = $categories;
        return view('admin.sub_category.sub-categories-insert', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required|unique:sub_categories',
            'category' => 'required',
            'status' => 'required'
        ]);
        if ($validator->passes()) {
            $subCategory = new SubCategory();
            $subCategory->name = $request->name;
            $subCategory->slug = $request->slug;
            $subCategory->status = $request->status;
            $subCategory->category_id = $request->category;
            $subCategory->save();

            if (!empty($request->image_id)) {
                $tempImage = TempImage::find($request->image_id);
                $extArray = explode('.', $tempImage->name);
                $ext = last($extArray);

                $newImageName = $subCategory->id . '.' . $ext;
                $sPath = public_path() . '/temp/' . $tempImage->name;
                $dPath = public_path() . '/uploads/sub category/' . $newImageName;
                File::copy($sPath, $dPath);

                $dPath = public_path() . '/uploads/sub category/thumb/' . $newImageName;
                $img = Image::make($sPath);
                $img->resize(450, 600);
                $img->save($dPath);

                $subCategory->image = $newImageName;
                $subCategory->save();
            }

            return response()->json([
                'status' => true,
                'message' => 'Sub Category added successfully'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }
    public function edit($subCategoryId, Request $request)
    {
        $subCategory = SubCategory::find($subCategoryId);

        $categories = Category::orderBy('name', 'ASC')->get();
        $data['subCategory'] = $subCategory;
        $data['categories'] = $categories;

        if (empty($subCategory)) {
            return redirect()->route('sub-categories.index');
        }
        return view('admin.sub_category.sub-categories-edit', $data);
    }

    public function update($subCategoryId, Request $request)
    {
        $subCategory = SubCategory::find($subCategoryId);


        if (empty($subCategory)) {
            return response()->json([
                'status' => false,
                'notFound' => true,
                'message' => 'sub category not found'
            ]);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required|unique:categories,slug,' . $subCategory->id . ',id',
            'category' => 'required',
            'status' => 'required'
        ]);
        if ($validator->passes()) {
            $subCategory->name = $request->name;
            $subCategory->slug = $request->slug;
            $subCategory->status = $request->status;
            if ($request->status == 0) {
                $subCategory->showHome = "No";
                $subCategory->is_featured = 0;
            }
            $subCategory->category_id = $request->category;
            $subCategory->save();

            $oldImage = $subCategory->image;

            if (!empty($request->image_id)) {
                $tempImage = TempImage::find($request->image_id);
                $extArray = explode('.', $tempImage->name);
                $ext = last($extArray);

                $newImageName = $subCategory->id . '-' . time() . '.' . $ext;
                $sPath = public_path() . '/temp/' . $tempImage->name;
                $dPath = public_path() . '/uploads/sub category/' . $newImageName;
                File::copy($sPath, $dPath);

                $dPath = public_path() . '/uploads/sub category/thumb/' . $newImageName;
                $img = Image::make($sPath);
                $img->resize(600, 600);
                $img->save($dPath);

                $subCategory->image = $newImageName;
                $subCategory->save();

                File::delete(public_path() . '/uploads/sub category/thumb/' . $oldImage);
                File::delete(public_path() . '/uploads/sub category/' . $oldImage);
            }

            return response()->json([
                'status' => true,
                'message' => 'sub Category added successfully'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function showHome($subCategoryId, Request $request)
    {
        $subCategory = SubCategory::find($subCategoryId);
        if (empty($subCategory)) {
            return response()->json([
                'status' => false,
                'notFound' => true,
                'message' => 'Category not found'
            ]);
        }

        $newShowHomeValue = $request->input('showHome');

        $subCategory->showHome = $newShowHomeValue;
        $subCategory->save();

        return response()->json([
            'status' => true,
            'message' => 'ShowHome updated successfully'
        ]);
    }

    public function isFeatured($subcategoryId, Request $request)
    {
        $subCategory = SubCategory::find($subcategoryId);
        if (empty($subCategory)) {
            return response()->json([
                'status' => false,
                'notFound' => true,
                'message' => 'subCategory not found'
            ]);
        }

        $newFeaturedValue = $request->input('isFeatured');

        $subCategory->is_featured = $newFeaturedValue;
        $subCategory->save();

        return response()->json([
            'status' => true,
            'message' => 'Featured updated successfully'
        ]);
    }

    public function destroy($subCategoryId, Request $request)
    {
        $subCategory = SubCategory::find($subCategoryId);
        if (empty($subCategory)) {
            alert("sub category not found");
            return response()->json([
                'status' => false,
                'message' => 'sub category not found'
            ]);
        }

        File::delete(public_path() . '/uploads/sub category/thumb/' . $subCategory->image);
        File::delete(public_path() . '/uploads/sub category/' . $subCategory->image);

        $subCategory->delete();

        return response()->json([
            'status' => true,
            'message' => 'sub Category deleted successfully'
        ]);
    }

    public function getSubCategories($categoryId)
    {
        $subCategories = SubCategory::where('category_id', $categoryId)->get();

        return response()->json($subCategories);
    }
}
