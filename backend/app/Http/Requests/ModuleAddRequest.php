<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Request;


class ModuleAddRequest extends BaseRequest
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
            'name' => 'required|string',
            'icon' => 'required|string',
            'sequence' => 'required|integer',
        ];

//        if(Request::isMethod('post')){
//            $rules['id'] = 'required|integer|unique:menu_submenu_permissions,id';
//        }

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
