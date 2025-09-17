<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePhotoRequest extends FormRequest
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
            'image'   => 'required|array',
            'image.*' => 'required|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'type'    => 'required|in:gallery,machine,company',
        ];
    }
    public function messages(): array
    {
        return [
            'image.required'   => 'Please upload at least one image.',
            'image.array'      => 'The image field must be an array.',
            'image.*.image'    => 'Each file must be an image.',
            'image.*.mimes'    => 'Each image must be JPG, JPEG,WEBP, PNG, or GIF.',
            'image.*.max'      => 'Each image must not exceed 2MB.',
            'type.required'    => 'Please select a type.',
            'type.in'          => 'The type must be either gallery,company or machine.',
        ];
    }
}
