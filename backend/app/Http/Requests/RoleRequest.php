<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Request;

class RoleRequest extends BaseRequest
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
        $rule_string = 'required|unique:roles,title|regex:'.$this->start_with_letter_only;

        if(request()->isMethod('PUT')){
            $rule_string = 'required|unique:roles,title,'.request('id').'|regex:'.$this->start_with_letter_only;
        }

        $rules = [
            'title'=>$rule_string,
        ];


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
            'title.regex'=>'Must be start with letter.'
        ];
    }
}
