<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3|max:30',
            'description' => 'required|min:5|max:500',
            'price' => 'required|numeric|min:1',
            'stock' => 'required|numeric|min:1',
            'featured_img' => 'required|file',
            'photos' => 'required',
            'photos.*' => 'file|mimes:jpeg,png,jpg,svg',
            'category_id' => 'required|exists:categories,id',
            'sub_category_id' => 'required|exists:sub_categories,id',
        ];
    }
}
