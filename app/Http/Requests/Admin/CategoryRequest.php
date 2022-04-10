<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        $rules = [
            'name'=>'required|string|min:3',
            'code'=>'required|string|min:3',
            'description'=>'required|string|min:3',
            'image'=>'image'
        ];
        if ($this->route()->named() == 'categories.update'){
            $rules['code'] = ',' . $this->route()->parameter('category')->id;
        }
        return $rules;

    }
}
