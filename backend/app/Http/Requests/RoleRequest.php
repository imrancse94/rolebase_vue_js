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
        $rules = [
            'title'=>'required|regex:'.$this->start_with_letter_only,
            //'company_id'=>'required|integer'
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
