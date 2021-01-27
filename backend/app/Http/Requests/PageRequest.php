<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Request;

class PageRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $rules = [
            'id'=>'required',
            'module_id'=>'required',
            'submodule_id'=>'required',
            'name'=>'required',
            'route_name'=>'required',
        ];

        if(Request::isMethod('post')){
            $rules['id'] = 'required|integer|unique:pages,id';
        }

        return $rules;
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            //
        ];
    }
}
