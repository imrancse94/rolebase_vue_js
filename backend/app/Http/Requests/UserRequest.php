<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Request;

class UserRequest extends BaseRequest
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
            'name'=>'required',
            'email'=>'required|email|unique:users,email',
            'password'=>'required',
            'c_password'=>'required|same:password'
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
            "c_password.same"=>"This doesn't match with password."
            
        ];
    }
}
