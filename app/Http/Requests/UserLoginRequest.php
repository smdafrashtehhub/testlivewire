<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserLoginRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email'=>'required|email|string',
            'password'=>'required|min:6'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(Response()->json([
            'status'=>false,
            'message'=>$validator->errors()
        ]));
    }
}
