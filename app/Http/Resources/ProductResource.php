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

    public function review($id){
        $product = Product::find($id);
        $reviews = $product->reviews;
        $rate = [];
        foreach ($reviews as $key=>$review){
            # (float) represented string "1" returned to number 1;
            $rate[$key] = (float)$review->rate;
        }
        $total_rate = array_sum($rate);
        return $percentage_of_rate = round((($total_rate/3000)*100),1)."%";
    }

    public function toArray($request)
    {
        if($this->featured_img == "default/shop.png"){
            $featured_img_link = asset($this->featured_img);
        }else{
            $featured_img_link = asset(Storage::url($this->featured_img));
        }


        # (object) represented array [] return to object {};
        $creator = (object)[
            "id"=>$this->user->id,
            "name"=>$this->user->name,
            "role" => $this->user->role,
        ];

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
            'review_percentages' => $this->review($this->id),
            'featured_img' => $featured_img_link,
            'photos' => PhotoResource::collection($this->photos),
            'creator' => $creator,
            'category' => $category,
            'sub_category' => $sub_category,
            'date' => $this->created_at->format("d/M/Y"),
            'time' => $this->created_at->format("H:i:s A"),
        ];

    }
}
