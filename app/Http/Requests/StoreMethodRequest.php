<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMethodRequest extends FormRequest
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
            'name' => 'required|array',
            'name.da' => 'required|string|max:255',
            'name.en' => 'required|string|max:255',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'name.array' => 'The name field must be a JSON array.',

            'name.da.required' => 'The Dari name is required.',
            'name.da.string' => 'The Dari name must be a string.',
            'name.da.max' => 'The Dari name must not exceed 255 characters.',

            'name.en.required' => 'The English name is required.',
            'name.en.string' => 'The English name must be a string.',
            'name.en.max' => 'The English name must not exceed 255 characters.',
        ];
    }
}
