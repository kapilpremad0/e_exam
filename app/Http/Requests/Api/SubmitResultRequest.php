<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class SubmitResultRequest extends FormRequest
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
            'level_id' => 'required|exists:levels,id',
            'questions' => 'required|array', // Ensures questions is an array and required
            'questions.*.question_id' => 'required|exists:questions,id', // Each question must have a valid ID
            'questions.*.answer' => 'nullable|string', // Each question must have an answer
        ];
    }
}
