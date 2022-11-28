<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Photo;
use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::search()->latest('id')->paginate(12)->withQueryString();
        return ProductResource::collection($products);
    }


    public function store(StoreProductRequest $request)
    {
        if(Gate::denies('allowUser',Product::class)){
            return response()->json(['message' => 'you are not administrator or editor']);
        };

        $product = new Product();
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->description = $request->description;
        $product->price = (float)$request->price;
        $product->stock = (float)$request->stock;
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

        return response()->json(
        [
            'success' => true,
            'message' => 'product was created' ,
            'data'=> new ProductResource($product)
        ]
    );
    }

    public function show($id)
    {
        $product = Product::find($id);
        if(is_null($product)){
            return response()->json(['message' => 'product not found']);
        }
        return new ProductResource($product);
    }


    public function update(UpdateProductRequest $request,$id)
    {
        if(Gate::denies('allowUser',Product::class)){
            return response()->json(['message' => 'you are not administrator or editor']);
        };

        $product = Product::find($id);
        if(is_null($product)){
            return response()->json(['message' => 'product not found']);
        }

        $product->name = $request->name;
        $product->slug = Str::slug($product->name);
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->category_id = $request->category_id;
        $product->sub_category_id = $request->sub_category_id;

        if($request->hasFile("featured_img")){
            $product->featured_img = $request->file("featured_img")->store("public/featured_images");
        }

        $product->update();
        if($request->photos){
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
        }

        return response()->json(
            [
                'success' => true,
                'message' => 'product was updated' ,
                'data'=> new ProductResource($product)
            ]
        );

    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if(is_null($product)){
            return response()->json(['message' => 'product not found']);
        }
        $product->delete();
        return response()->json(
            [
                'success' => true,
                'message' => 'product was deleted' ,
            ],200
        );
    }
}
