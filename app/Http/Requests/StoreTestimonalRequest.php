<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTestimonalRequest extends FormRequest
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
            'name' => 'required|array',
            'name.*' => 'required|string|max:255',

            'position' => 'required|array',
            'position.*' => 'required|string|max:255',

            'description' => 'required|array',
            'description.*' => 'required|string',

            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',

            'rate' => 'required|numeric',

            'status' => 'required|boolean',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'name.array' => 'The name must be a valid JSON object.',
            'name.*.required' => 'Each name value is required.',
            'name.*.string' => 'Each name must be a string.',
            'name.*.max' => 'Each name must not exceed 255 characters.',

            'position.required' => 'The position field is required.',
            'position.array' => 'The position must be a valid JSON object.',
            'position.*.required' => 'Each position value is required.',
            'position.*.string' => 'Each position must be a string.',
            'position.*.max' => 'Each position must not exceed 255 characters.',

            'description.required' => 'The description field is required.',
            'description.array' => 'The description must be a valid JSON object.',
            'description.*.required' => 'Each description value is required.',
            'description.*.string' => 'Each description must be a string.',

            'rate.required' => 'The rate field is required.',
            'rate.numeric' => 'The rate field must be a integer.',

            'image.image' => 'The file must be an image.',
            'image.mimes' => 'The image must be of type: jpeg, png, jpg, or webp.',
            'image.max' => 'The image must not exceed 2MB.',

            'status.required' => 'The status field is required.',
            'status.boolean' => 'The status must be true or false.',
        ];
    }
}
