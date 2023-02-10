<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\CategoryStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Resources\CategoriesResource;
class CategoryController extends Controller
{
    public function categoryDetails()
    {
        try {
            $data = CategoriesResource::collection(Category::where('status',CategoryStatusEnum::Active)->get());
            return $this->SuccessResponse(
                200,
                $data,
                ["Successful"],
                200,
                'success'
            );
        } catch (\Exception $e) {
            return $this->FailResponse(500, ["Something Wrong"], false, 500);
        }
    }
}
