<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{

    public function toArray($request)
    {
        # (object) represented array [] return to object {}
        $user = (object)[
            "id"=>$this->user->id,
            "name"=>$this->user->name,
        ];

        $product = (object)[
            "id"=>$this->product->id,
            "name"=>$this->product->name,
        ];
        return [
            'id' => $this->id,
            'rate' => $this->rate,
            'user' => $user,
            'product' => $product,
            'date' => $this->created_at->format("d/M/Y"),
            'time' => $this->created_at->format("H:i:s A"),
        ];
    }
}
