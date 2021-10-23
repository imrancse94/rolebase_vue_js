<?php

namespace App\Http\Requests;

use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Pearl\RequestValidate\RequestAbstract;
use App\Http\Traits\ApiResponseTrait;

class BaseRequest extends RequestAbstract
{
    use ApiResponseTrait;

    protected $start_with_letter_only = '/^[A-Za-z][A-Za-z0-9 ]*(?:_[A-Za-z0-9 ]+)*$/u';

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
        return [
            //
        ];
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

    protected function failedValidation(Validator $validator): ValidationException
    {
        $errors = (new ValidationException($validator))->errors();
        $errorData = [];
        if(!empty($errors)){
            foreach($errors as $key => $err){
                $message = current($err);
                $message_array = explode(".",$message);
                if($message_array[1] == "required"){
                    $message = "The field is required.";
                }else if($message_array[1] == "unique"){
                    $message = "The value already exist.";
                }
                $errorData[$key] = $message;
            }
        }
        
        throw new HttpResponseException($this->sendError("validation error", $errorData,1000));
    }
}
