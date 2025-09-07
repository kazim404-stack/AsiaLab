<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAboutImageRequest extends FormRequest
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
            "about_us_id" => "required|integer|exists:about_us,id",
            'image' => 'required|array',
            'image.*' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ];
    }
    public function messages(): array
    {
        return [
            'about_us_id.required' => 'Please select about.',
            'about_us_id.integer' => 'The about ID must be a valid number.',
            'about_us_id.exists' => 'The selected about does not exist.',

            'image.required' => 'The image is required.',
            'image.array' => 'Invalid image upload format.',
            'image.*.image' => 'Each file must be a valid image.',
            'image.*.mimes' => 'Only jpeg, png, jpg, and webp formats are allowed.',
            'image.*.max' => 'Each image must not be larger than 2 MB.',
        ];
    }
}
