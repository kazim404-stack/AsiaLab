<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKeyValueRequest extends FormRequest
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
            'title' => 'required|array',
            'title.*' => 'required|string|max:255',

            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',

            'description' => 'required|array',
            'description.*' => 'required|string',

        ];
    }
    public function messages(): array
    {
        return [
            'title.array' => 'The title must be a valid JSON object.',
            'title.*.string' => 'Each title must be a text string.',
            'title.*.max' => 'Each title may not exceed 255 characters.',

            'title.required' => 'The title is required.',
            'description.required' => 'The description is required.',
            'image.required' => 'The image is required.',
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, webp.',
            'image.max' => 'The image must not be larger than 2MB.',

            'description.array' => 'The description must be a valid JSON object.',
            'description.*.string' => 'Each description must be a text string.',
            'description.*.required' => 'The description is required.',
        ];
    }
}
