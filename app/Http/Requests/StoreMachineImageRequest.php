<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMachineImageRequest extends FormRequest
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
            'machine_id' => ['required', 'integer', 'exists:machines,id'],
            'image'      => ['required', 'array'],
            'image.*'    => ['image', 'max:2048', 'mimes:jpg,jpeg,png,gif,bmp,webp,svg'],
            'is_primary' => ['nullable', 'boolean'],
        ];
    }
    public function messages(): array
    {
        return [
            'machine_id.required' => 'The machine ID is required.',
            'machine_id.integer'  => 'The product ID must be an integer.',
            'machine_id.exists'   => 'The selected machine_id does not exist.',

            'image.required'      => 'Please upload at least one image.',
            'image.array'         => 'The images must be provided as an array.',

            'image.*.image'       => 'Each file must be a valid image.',
            'image.*.max'         => 'Each image must not be larger than 2MB.',
            'image.*.mimes'       => 'Each image must be a file of type: jpg, jpeg, png, gif, bmp, webp, svg.',

            'is_primary.boolean'  => 'The is_primary field must be true or false.',
        ];
    }
}
