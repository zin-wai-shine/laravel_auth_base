<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    public function toArray($request)
    {
        $user = (object)[
            "id"=>$this->user->id,
            "name"=>$this->user->name,
        ];

        $product = (object)[
            "id"=>$this->product->id,
            "name"=>$this->product->name,
        ];

        return [
            'id' =>$this->id,
            'description' => $this->description,
            'user' => $user,
            'product' => $product,
            'date' => $this->created_at->format("d/M/Y"),
            'time' => $this->created_at->format("H:i:s A"),
        ];
    }
}
