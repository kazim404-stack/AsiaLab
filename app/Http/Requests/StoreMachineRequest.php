<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMachineRequest extends FormRequest
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
            'method_id'         => 'required|exists:methods,id',

            'name'              => 'required|array',
            'name.da'           => 'required|string|max:255',
            'name.en'           => 'required|string|max:255',

            'model'             => 'required|string|max:255',

            'description'       => 'nullable|array',
            'description.da'    => 'nullable|string',
            'description.en'    => 'nullable|string',

            'status'            => 'required|boolean',
        ];
    }
    public function messages(): array
    {
        return [
            'method_id.required'       => 'The method field is required.',
            'method_id.exists'         => 'The selected method is invalid.',

            'name.required'            => 'The name field is required.',
            'name.array'               => 'The name must be a JSON object.',
            'name.da.required'         => 'The name in Dari is required.',
            'name.da.string'           => 'The name in Dari must be a string.',
            'name.da.max'              => 'The name in Dari must not exceed 255 characters.',
            'name.en.required'         => 'The name in English is required.',
            'name.en.string'           => 'The name in English must be a string.',
            'name.en.max'              => 'The name in English must not exceed 255 characters.',

            'model.required'           => 'The model field is required.',
            'model.string'             => 'The model must be a string.',
            'model.max'                => 'The model must not exceed 255 characters.',

            'description.array'        => 'The description must be a JSON object.',
            'description.da.string'    => 'The description in Dari must be a string.',
            'description.en.string'    => 'The description in English must be a string.',

            'status.required'          => 'The status field is required.',
            'status.boolean'           => 'The status must be true or false.',
        ];
    }
}
