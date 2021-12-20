<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditProductRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'slug'        => 'required|unique:products,slug,' . $this->product->id,
            'name'        => 'required|unique:products,name,' . $this->product->id,
            'description' => 'required|max:255',
            'price'       => 'required|numeric|min:1',
            'image'       => 'nullable|image|max:512',
            'category_id' => 'required|exists:categories,id',
            'labels'      => 'nullable'
        ];
    }
}
