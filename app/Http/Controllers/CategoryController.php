<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Models\User;
use http\Env\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use function PHPUnit\Framework\isEmpty;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::search()->latest('id')->paginate(2)->withQueryString();
        return CategoryResource::collection($categories);
    }

    public function store(StoreCategoryRequest $request)
    {
        if(Gate::denies('allowUser',Category::class)){
            return response()->json(['message' => 'user is not allowed']);
        };

        $category = new Category();
        $category->name = $request->name;
        $category->slug = Str::slug($category->name);
        $category->user_id = Auth::id();
        $category->save();

        return response()->json(['message' => 'category was created']);
    }

    public function show($id)
    {
        if(Gate::denies('allowUser',Category::class)){
            return response()->json(['message' => 'user is not allowed']);
        };

        $category = Category::find($id);
        if(is_null($category)){
            return response()->json(['message'=>'category not found']);
        }
        return new CategoryResource($category);
    }

    public function update(UpdateCategoryRequest $request, $id)
    {
        if(Gate::denies('allowUser',Category::class)){
            return response()->json(['message' => 'user is not allowed']);
        };

        $category = Category::find($id);
        if(is_null($category)){
            return response()->json(['message' => 'category not found']);
        }
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->user_id = Auth::id();
        $category->update();
        return response()->json(['message' => 'category was updated']);
    }


    public function destroy($id)
    {
        if(Gate::denies('allowUser',Category::class)){
            return response()->json(['message' => 'user is not allowed']);
        };

        $category = Category::find($id);
        if(is_null($category)){
            return response()->json(['message' => 'category not found']);
        }
        $category->delete();
        return response()->json(['message' => 'category was deleted'], 204);
    }

}
