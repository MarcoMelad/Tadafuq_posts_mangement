<?php

namespace App\Http\Requests\Authentication;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rules\Password;

class RegisterUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'user_name'  => 'required|string|max:255|unique:users',
            'password'   => ['required', Password::min(8)->mixedCase()->numbers()->symbols()],
            'email'      => 'required|email|unique:users',
            'phone'      => 'required|string|min:11|max:13|unique:users',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'status_code' => 422,
            'code' => 1422,
            'hint' => 'Unprocessable Entity',
            'errors' => $validator->errors(),
        ], 422));
    }
}
