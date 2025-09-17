<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
            'parent_id'    => 'nullable|integer',
            'name'         => 'required|array',
            'fa_icon'         => 'nullable|string',
            'name.*'       => 'required|string|max:255',
            'description' => ['nullable', 'array'],
            'description.en' => ['nullable', 'string'],
            'description.da' => ['nullable', 'string'],
            'description.pa' => ['nullable', 'string'],
            'image'        => 'nullable|image|mimes:jpg,jpeg,png,svg,webp|max:2048',
            'status'       => 'boolean',
        ];
    }
    public function messages(): array
    {
        return [
            'parent_id.exists'       => 'The selected parent category does not exist.',
            'name.required'          => 'The name field is required.',
            'name.array'             => 'The name must be a JSON object.',
            'name.*.required'        => 'Each language version of the name is required.',
            'name.*.string'          => 'Each name must be a string.',
            'name.*.max'             => 'Each name must not exceed 255 characters.',
            'description.array' => 'The description must be a JSON object.',
            'description.en.string' => 'The English description must be a string.',
            'description.da.string' => 'The Dari description must be a string.',
            'description.pa.string' => 'The Pashto description must be a string.',
            'image.image'            => 'The uploaded file must be an image.',
            'image.mimes'            => 'The image must be a file of type: jpg, jpeg, png, svg and webp.',
            'image.max'              => 'The image size must not exceed 2MB.',
            'status.required'        => 'The status field is required.',
            'status.boolean'         => 'The status must be true or false.',

            'fa_icon.string'          => 'The fa_icon must be a string.',

        ];
    }
}
