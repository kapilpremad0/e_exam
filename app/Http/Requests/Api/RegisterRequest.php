<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
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
            'name' => 'required',
            'email' => [
                'required', 
                'string', 
                'email', 
                Rule::unique('users', 'email')->where('is_verify', 1), // Check if email exists where is_verify = 1
            ],
            'mobile' => [
                'required', 
                'digits:10', 
                'numeric',
                Rule::unique('users', 'mobile')->where('is_verify', 1), // Check if email exists where is_verify = 1
            ],
            'password' => 'required|string|min:6',
            'address' => 'required|string',
            'city_id' => 'required|exists:cities,id',
            'state_id' => 'required|exists:states,id',
            'image' => 'required|image',
        ];
    }
}
