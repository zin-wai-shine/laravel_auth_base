<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubCategoryRequest;
use App\Http\Requests\UpdateSubCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\SubCategoryResource;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
    public function allowUser(){
        if(Gate::denies('allowUser',SubCategoryController::class)){
            return response()->json(['message' => 'user is not allowed']);
        };
    }

    public function index()
    {
        // We are building search scope in relative Model....( search() )....
        $subCategories = SubCategory::search()->latest('id')->paginate(7)->withQueryString();
        return SubCategoryResource::collection($subCategories);
    }

    public function store(StoreSubCategoryRequest $request)
    {
        $this->allowUser();
        $subCategory = new SubCategory();
        $subCategory->name          = $request->name;
        $subCategory->slug          = Str::slug($subCategory->name);
        $subCategory->user_id       = Auth::id();
        $subCategory->category_id   = $request->category_id;
        $subCategory->save();
        return response()->json($subCategory);
    }

    public function show(SubCategory $subCategory)
    {
        $this->allowUser();

    }

    public function edit(SubCategory $subCategory)
    {
        $this->allowUser();
    }

    public function update(UpdateSubCategoryRequest $request, SubCategory $subCategory)
    {
        $this->allowUser();
    }

    public function destroy(SubCategory $subCategory)
    {
        $this->allowUser();

    }
}
