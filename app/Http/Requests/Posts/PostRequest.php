<?php

namespace App\Http\Requests\Posts;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
        if ($this->getMethod() === 'POST') {
            return [
                'title' => 'required|string|max:255',
                'description' => 'required|string|max:2048',
                'contact_phone' => 'required|string',
            ];
        }
        return [
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:2048',
            'contact_phone' => 'nullable|string',
        ];
    }
}
