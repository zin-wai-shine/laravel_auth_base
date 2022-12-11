<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "description" => "required|min:1|max:300",
            "product_id"  => "required|exists:products,id"
        ];
    }
}
