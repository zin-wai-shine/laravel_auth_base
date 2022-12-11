<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReviewRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'rate' => 'numeric|min:0|max:5',
            'product_id' => 'exists:products,id'
        ];
    }
}
