<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSliderImageRequest extends FormRequest
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
            "slider_id" => "required|integer|exists:sliders,id",
            "type" => "string|in:da,en,pa",
            'image' => 'required|array',
            'image.*' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ];
    }
    public function messages(): array
    {
        return [
            'slider_id.required' => 'Please select a slider.',
            'slider_id.integer' => 'The slider ID must be a valid number.',
            'slider_id.exists' => 'The selected slider does not exist.',

            'image.required' => 'The image is required.',
            'image.array' => 'Invalid image upload format.',
            'image.*.image' => 'Each file must be a valid image.',
            'image.*.mimes' => 'Only jpeg, png, jpg, and webp formats are allowed.',
            'image.*.max' => 'Each image must not be larger than 2 MB.',

            'type.string' => 'The type must be a text value.',
            'type.in' => 'The type must be either "da" or "en".',
        ];
    }
}
