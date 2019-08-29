<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostsValidations extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:55',
            'content' => 'required|min:10',
            'image' => 'required|url'
        ];
    }
}
