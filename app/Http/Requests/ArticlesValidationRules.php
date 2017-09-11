<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticlesValidationRules extends FormRequest
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
            'picture.*' => 'required|image|mimes:jpg,jpeg,png,bmp|max:2000',
            'title' => 'required|string',
            'slug' => 'nullable|string|min:2|max:50',
            'abstract' => 'required|string|min:2|max:255',
            'content' => 'required|string'
        ];
    }
}
