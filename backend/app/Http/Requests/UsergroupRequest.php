<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Request;

class UsergroupRequest extends BaseRequest
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

        $rule_string = 'required|unique:usergroups,name|regex:'.$this->start_with_letter_only;

        if(request()->isMethod('PUT')){
            $rule_string = 'required|unique:usergroups,name,'.request('id').'|regex:'.$this->start_with_letter_only;
        }

        $rules = [
            'name'=>$rule_string,
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
            'name.regex'=>'Must be start with letter.'
        ];
    }
}
