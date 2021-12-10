<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditCategoryRequest extends FormRequest
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
            'code' => 'required|min:3',
            'name' => 'required|min:3|unique:categories,name,' . $this->category->id,
            'description' => 'required|min:12',
            'image' => 'nullable|image|max:1024'
        ];
    }
}
