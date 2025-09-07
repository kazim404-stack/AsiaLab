<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTestRequest extends FormRequest
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
            'category_id' => ['required', 'exists:categories,id'],
            'name' => ['required', 'array'],
            'name.en' => ['required', 'string', 'max:255'],
            'name.da' => ['required', 'string', 'max:255'],
            'name.pa' => ['required', 'string', 'max:255'],
            'unite' => ['nullable', 'string', 'max:255'],
            'refrence' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'array'],
            'description.en' => ['nullable', 'string'],
            'description.da' => ['nullable', 'string'],
            'description.pa' => ['nullable', 'string'],
            'status' => ['boolean'],
        ];
    }
    public function messages(): array
    {
        return [
            'category_id.required' => 'The category field is required.',
            'category_id.exists' => 'The selected category does not exist.',

            'name.required' => 'The name field is required.',
            'name.array' => 'The name must be a JSON object.',
            'name.en.required' => 'The name in English is required.',
            'name.en.string' => 'The English name must be a string.',
            'name.en.max' => 'The English name may not be greater than 255 characters.',
            'name.da.required' => 'The name in Dari is required.',
            'name.da.string' => 'The Dari name must be a string.',
            'name.da.max' => 'The Dari name may not be greater than 255 characters.',

            'name.pa.required' => 'The name in Pashto is required.',
            'name.pa.string' => 'The Pashto name must be a string.',
            'name.pa.max' => 'The Pashto name may not be greater than 255 characters.',

            'unite.string' => 'The unit must be a string.',
            'unite.max' => 'The unit may not be greater than 255 characters.',

            'refrence.string' => 'The reference must be a string.',
            'refrence.max' => 'The reference may not be greater than 255 characters.',

            'description.array' => 'The description must be a JSON object.',
            'description.en.string' => 'The English description must be a string.',
            'description.da.string' => 'The Dari description must be a string.',
            'description.pa.string' => 'The Pashto description must be a string.',

            'status.boolean' => 'The status must be true or false.',


        ];
    }
}
