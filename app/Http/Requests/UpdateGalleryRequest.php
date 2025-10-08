<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGalleryRequest extends FormRequest
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
            'branch_name' => 'required|array',
            'branch_name.*' => 'required|string|max:255',
            'image.*'    => 'nullable|image|max:2048|mimes:jpg,jpeg,png,gif,bmp,webp,svg',
        ];
    }
    public function messages()
    {
        return [
            'branch_name.required' => 'The branch name field is required.',
            'branch_name.array' => 'The branch name must be an array of translations.',
            'branch_name.*.required' => 'Each branch name translation is required.',
            'branch_name.*.string' => 'Each branch name must be a string.',
            'branch_name.*.max' => 'Each branch name must not exceed 255 characters.',


            'image.*.image'       => 'Each file must be a valid image.',
            'image.*.max'         => 'Each image must not be larger than 2MB.',
            'image.*.mimes'       => 'Each image must be a file of type: jpg, jpeg, png, gif, bmp, webp, svg.',

        ];
    }
}
