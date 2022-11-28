<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Photo;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::search()->latest('id')->paginate(7)->withQueryString();
        return response()->json($products);
    }


    public function store(StoreProductRequest $request)
    {
        $product = new Product();
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->user_id = Auth::id();
        $product->category_id = $request->category_id;
        $product->sub_category_id = $request->sub_category_id;
        if($request->hasFile("featured_img")){
            $product->featured_img = $request->file("featured_img")->store("public/featured_images");
        }
        $product->save();
        $productPhotos = [];
        foreach ($request->photos as $key=>$photo){
            $photoName = $photo->store('public/product_photos');
            $productPhotos[$key] = [
                "name" => $photoName,
                "product_id" => $product->id,
                "user_id" => Auth::id(),
            ];
        }
        Photo::insert($productPhotos);

        return response()->json($product);
    }

    public function show(Product $product)
    {
        //
    }


    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    public function destroy(Product $product)
    {
        //
    }
}
