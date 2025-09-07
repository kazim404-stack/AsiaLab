<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGeneralSettingRequest extends FormRequest
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
            'site_name' => 'required|string|max:255',
            'logo' => 'required|image|mimes:jpg,jpeg,png,svg,webp|max:2048', // assuming file upload
            'facebook' => 'nullable|url',
            'instagram' => 'nullable|url',
            'whatsapp' => 'nullable|string|max:255',
            'youtube' => 'nullable|url',
            'telegram' => 'nullable|url',
            'x' => 'nullable|url',
            'linkedin' => 'nullable|url',
        ];
    }
    public function messages(): array
    {
        return [
            'site_name.required' => 'The site name is required.',
            'logo.required' => 'The logo is required.',
            'logo.image' => 'The logo must be an image.',
            'logo.mimes' => 'The logo must be a file of type: jpg, jpeg, png, svg,webp.',
            'logo.max' => 'The logo may not be greater than 2MB.',
            'facebook.url' => 'The Facebook URL must be valid.',
            'instagram.url' => 'The Instagram URL must be valid.',
            'whatsapp.max' => 'The WhatsApp number must not exceed 20 characters.',
            'youtube.url' => 'The YouTube URL must be valid.',
            'telegram.url' => 'The telegram URL must be valid.',
            'x.url' => 'The x URL must be valid.',
            'linkedin.url' => 'The linkedin URL must be valid.',
        ];
    }
}
