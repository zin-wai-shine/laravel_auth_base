<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Psy\Util\Str;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'    =>$this->id,
            'name'  => $this->name,
            'slug'  => $this->slug,
            'creator'=> new UserResource($this->user),
            'date'  => $this->created_at->format('d/M/Y'),
            'time'  => $this->created_at->format('h:i:s A')
        ];
    }
}
