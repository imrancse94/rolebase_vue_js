<?php

namespace App\Http\Requests;


use Illuminate\Support\Facades\Request;

class SubmoduleRequest extends BaseRequest
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
            'module_id'=>'required|integer',
            'name' => 'required|string',
            'icon' => 'required|string',
            'sequence' => 'required|integer',
            'controller_name'=>'required',
            'default_method'=>'required'
        ];

        if(Request::isMethod('post')){
            $rules['id'] = 'required|integer|unique:submodules,id';
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
            'module_id.required'=>'Please select module name'
        ];
    }
}
