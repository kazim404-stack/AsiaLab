<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTestImageRequest extends FormRequest
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
            'test_id' => ['required', 'integer', 'exists:tests,id'],
            'image'      => ['required', 'array'],
            'image.*'    => ['image', 'max:2048', 'mimes:jpg,jpeg,png,gif,bmp,webp,svg'],
        ];
    }
    public function messages(): array
    {
        return [
            'test_id.required' => 'The test ID is required.',
            'test_id.integer'  => 'The test ID must be an integer.',
            'test_id.exists'   => 'The selected test_id does not exist.',

            'image.required'      => 'Please upload at least one image.',
            'image.array'         => 'The images must be provided as an array.',

            'image.*.image'       => 'Each file must be a valid image.',
            'image.*.max'         => 'Each image must not be larger than 2MB.',
            'image.*.mimes'       => 'Each image must be a file of type: jpg, jpeg, png, gif, bmp, webp, svg.',
        ];
    }
}
