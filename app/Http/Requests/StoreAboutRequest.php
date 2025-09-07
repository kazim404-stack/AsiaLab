<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAboutRequest extends FormRequest
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
            'type' => 'nullable|string|max:255',
            'title.en' => 'required|string|max:255',
            'title.da' => 'required|string|max:255',
            'title.pa' => 'required|string|max:255',
            'description' => 'required|array',
            'description.en' => 'required|string',
            'description.da' => 'required|string',
            'description.pa' => 'required|string',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }


    public function messages(): array
    {
        return [
            'title.required' => 'The title is required.',
            'title.*.required' => 'Each language version of the title is required.',
            'description.required' => 'The description is required.',
            'description.*.required' => 'Each language version of the description is required.',
            'image.required' => 'The image is required.',
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'Only jpg, jpeg, png, and webp formats are allowed.',
            'image.max' => 'The image size must not exceed 2MB.',
            'type.string' => 'The type must be a valid string.',
            'type.max' => 'The type may not be greater than 255 characters.',
        ];
    }
}
