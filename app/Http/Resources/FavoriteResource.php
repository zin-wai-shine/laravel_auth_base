<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FavoriteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
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
            'id' => $this->id,
            'user' => $user,
            'product' => $product,
            'date' => $this->created_at->format("d/M/Y"),
            'time' => $this->created_at->format("H:i:s A"),
        ];
    }
}
