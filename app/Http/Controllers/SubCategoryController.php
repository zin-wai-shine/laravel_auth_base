<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubCategoryRequest;
use App\Http\Requests\UpdateSubCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\SubCategoryResource;
use App\Models\Category;
use App\Models\SubCategory;
use Faker\Core\Number;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{

    public function index()
    {
        // We are building search scope in relative Model....( search() )....
        $subCategories = SubCategory::search()->latest('id')->paginate(7)->withQueryString();
        return SubCategoryResource::collection($subCategories);
    }

    public function store(StoreSubCategoryRequest $request)
    {
        if(Gate::denies('allowUser',SubCategory::class)){
            return response()->json(['message' => 'you are not administrator or editor']);
        };

        $subCategory = new SubCategory();
        $subCategory->name          = $request->name;
        $subCategory->slug          = Str::slug($subCategory->name);
        $subCategory->user_id       = Auth::id();
        $subCategory->category_id   = (float)$request->category_id;
        $subCategory->save();
        return response()->json(
            [
                'success' => true,
                'message' => 'subCategory was created' ,
                'data'=> new SubCategoryResource($subCategory)
            ]
        );
    }

    public function show($id)
    {
        $subCategory = SubCategory::find($id);
        if(is_null($subCategory)){
            return response()->json(['message' => 'subCategory not found']);
        }
        return new SubCategoryResource($subCategory);
    }


    public function update(UpdateSubCategoryRequest $request, $id)
    {
        if(Gate::denies('allowUser',SubCategory::class)){
            return response()->json(['message' => 'you are not administrator or editor']);
        };
        $subCategory = SubCategory::find($id);
        if(is_null($subCategory)){
            return response()->json(['message' => 'subCategory not found']);
        };
        $subCategory->name          = $request->name;
        $subCategory->slug          = Str::slug($subCategory->name);
        $subCategory->user_id       = Auth::id();
        $subCategory->update();

        return response()->json(
            [
                'success' => true,
                'message' => 'subCategory was updated' ,
                'data'=> new SubCategoryResource($subCategory)
            ]
        );

    }

    public function destroy($id)
    {
         if(Gate::denies('allowUser',SubCategory::class)){
            return response()->json(['message' => 'you are not administrator or editor']);
        };
        $subCategory = SubCategory::find($id);
        if(is_null($subCategory)){
            return response()->json(['message' => 'subCategory not found']);
        };
        $subCategory->delete();
        return response()->json(
            [
                'success' => true,
                'message' => 'subCategory was deleted' ,
            ],200
        );
    }
}
