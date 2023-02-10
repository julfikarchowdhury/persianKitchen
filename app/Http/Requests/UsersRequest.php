<?php

namespace App\Http\Requests;

use App\Http\Controllers\Controller;
use App\Http\Traits\ResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UsersRequest extends FormRequest
{
    use ResponseTrait;
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
            'name' => 'required|min:4|string|between:2,100',
            'email' => 'required|email|max:100|unique:users',
            'password' => 'required|min:8',
            'otp'=>'nullable|exists:users,otp'
        ];
    }
    public function messages(){
        return [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required'
        ];
    }
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->ValidationResponse(200,$validator));
    }
}
