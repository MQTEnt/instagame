<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagFormRequest extends FormRequest
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
        $id = $this->id;
        return [
            'name' => 'required|min:2|unique:tags,name,'.$id,
            'desc' => 'required|min:5'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Please fill tag name',
            'name.min' => 'Requires at least 2 characters',
            'name.unique' => 'Tag name was used before',
            'desc.required' => 'Please fill tag description',
            'desc.min' => 'Requires at least 5 characters'
        ];
    }
}
