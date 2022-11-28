<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductResource extends JsonResource
{
    public function stockStatus($count){
        $status = "";
        if($count > 15){
            $status = "available";
        }else if($count > 0){
            $status = "few";
        }else if($count === 0){
            $status = "out of stock";
        }
        return $status;
    }

    public function toArray($request)
    {
        $featured_img_link = asset(Storage::url($this->featured_img));
        $category = (object)[
            "id"=>$this->category_id,
            "name"=>$this->category->name
        ];

        $sub_category = (object)[
            "id"=>$this->sub_category_id,
            "name"=>$this->subCategory->name
        ];

        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'price' => (float)$this->price,
            'stock' => (float)$this->stock,
            'stock_status' => $this->stockStatus((float)$this->stock),
            'featured_img' => $featured_img_link,
            'photos' => PhotoResource::collection($this->photos),
            'user_id' => $this->user_id,
            'category' => $category,
            'sub_category' => $sub_category,
            "date" => $this->created_at->format("d/M/Y"),
            "time" => $this->created_at->format("H:i:s A"),
        ];

    }
}
