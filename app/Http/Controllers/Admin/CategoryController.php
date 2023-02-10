<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use App\Enums\CategoryStatusEnum;

class CategoryController extends Controller
{
    public function allCategory()
    {
        $data['categories'] = Category::get()->all();
        return view('admin.category.all-category', $data);
    }

    public function addCategory()
    {
        return view('admin.category.add-category');
    }
    public function editCategory(Category $category)
    {
        return view('admin.category.edit-category', ['category' => $category]);
    }
    public function addEditCategory(Request $request, $id = null)
    {
        $validator = Validator::make($request->all(), [
            'category_name' => 'required|max:25',
            'details' => 'max:256',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        try {
            $data = [
                'name' => $request->category_name,
                'details' => $request->details,
                'status' => CategoryStatusEnum::fromName($request->status)
            ];
            if ($request->hasFile('image')) {
                $image = $request->image;
                $imageName = $image->getClientOriginalName();
                $image->storeAs('public/admin/images/category-images', $imageName);
                $data['image_url'] = $imageName;
            }
            //creating or updating data
            Category::updateOrCreate(['id' => $id], $data);
            //returning to all category page
            return redirect('admin/category')->with('success_message', "Successfully Save or  Update data");
        } catch (\Exception $e) {
            Log::debug('PassportAuth create => ' . $e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            return back()->withErrors($e->getMessage())->withInput();
        }
    }
    public function showCategoryDetails($id)
    {
        $category = Category::find($id);
        return view('admin.category.show-category-details', compact('category'));
    }

    public function deleteCategory($id)
    {
        try {
            Category::where('id', $id)->delete();
            return redirect()->back()->with('success_message', "Category has been deleted successfully!");
        } catch (\Exception $e) {
            Log::debug('PassportAuth create => ' . $e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            return back()->withErrors($e->getMessage())->withInput();
        }
    }
}
