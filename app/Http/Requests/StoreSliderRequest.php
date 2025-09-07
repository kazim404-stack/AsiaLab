<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSliderRequest extends FormRequest
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
            'title' => 'nullable|array',
            'title.*' => 'nullable|string|max:255',



            'description' => 'nullable|array',
            'description.*' => 'nullable|string',

            'status' => 'required|boolean',
        ];
    }
    public function messages(): array
    {
        return [
            'title.array' => 'The title must be a valid JSON object.',
            'title.*.string' => 'Each title must be a text string.',
            'title.*.max' => 'Each title may not exceed 255 characters.',



            'description.array' => 'The description must be a valid JSON object.',
            'description.*.string' => 'Each description must be a text string.',

            'status.required' => 'The status is required.',
            'status.boolean' => 'The status must be true or false.',
        ];
    }
}
