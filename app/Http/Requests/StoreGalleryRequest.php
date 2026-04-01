<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGalleryRequest extends FormRequest
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
            'contact_id' => 'required|exists:contacts,id',
            'image' => 'required|array|max:5',
            'image.*'    => 'required|image|max:2048|mimes:jpg,jpeg,png,gif,bmp,webp,svg',
        ];
    }
    public function messages()
    {
        return [
            'contact.required' => 'The contact field is required.',
            'contact.exists'   => 'The selected contact is invalid.',
            'image.required' => 'Please select at least one image.',
            'image.*.required' => 'The image name field is required.',
            'image.*.image'       => 'Each file must be a valid image.',
            'image.*.max'         => 'Each image must not be larger than 2MB.',
            'image.*.mimes'       => 'Each image must be a file of type: jpg, jpeg, png, gif, bmp, webp, svg.',

        ];
    }
}
