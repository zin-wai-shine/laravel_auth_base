<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class PhotoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $photos = asset(Storage::url($this->name));
        # Why we need to pass id in return?
        # --> we need an id when we want to update our product photos, delete rejected photos and instead store new uploaded photos;
        return [
            'id' => $this->id,
            'photo' => asset(Storage::url($photos))
        ];
    }
}
