<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name'=>'required|string|min:3',
            'category_id'=>'required|integer',
            'code'=>'required|string|min:3',
            'description'=>'required|string|min:3',
            'image'=>'image',
            'price'=>'required|required|numeric|min:1',
            'new'=>'string',
            'hit'=>'string',
            'recommend'=>'string'
        ];
    }
}
