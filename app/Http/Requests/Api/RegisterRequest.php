<?php

namespace App\Http\Requests\Api;

use App\Services\CustomFormRequest;
use App\Traits\Api\Request\RequestValidationErrorResponse;

class RegisterRequest extends CustomFormRequest
{
    use RequestValidationErrorResponse;

    /**
     * Determine if the user is authorized to make this request.
     */
    // public function authorize(): bool
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'              => 'required|string|min:3|max:255',
            'email'             => 'required|email|max:255|unique:users,email',
            'password'          => 'required|min:6',
            'confirm_password'  => 'required|same:password',
        ];
    }
}
