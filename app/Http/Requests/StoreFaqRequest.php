<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFaqRequest extends FormRequest
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
            "question" => 'required|array',
            "question.*" => 'required|string',

            "answear" => 'required|array',
            "answear.*" => 'required|string',


            'status'   => ['required', 'integer', 'in:0,1'],
        ];
    }
    public function messages(): array
    {
        return [
            'answear.array' => 'The answear must be a valid JSON object.',
            'answear.*.string' => 'Each answear must be a text string.',
            'answear.*.required' => 'The answear is required.',

            'question.array' => 'The question must be a valid JSON object.',
            'question.*.string' => 'Each question must be a text string.',
            'question.*.required' => 'The question is required.',

            'status.required'   => 'The status field is required.',
            'status.integer'    => 'The status must be a number.',
            'status.in'         => 'The status must be either 0 (inactive) or 1 (active).',
        ];
    }
}
