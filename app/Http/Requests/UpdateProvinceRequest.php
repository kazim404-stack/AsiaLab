<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProvinceRequest extends FormRequest
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
            'province' => ['required', 'array'],
            'province.*' => ['required', 'string', 'max:255'],
        ];
    }
    public function messages()
    {
        return [

            'province.required'      => 'The province field is required.',
            'province.array'         => 'The province must be an array of translations.',
            'province.*.required'    => 'Each province translation is required.',
            'province.*.string'      => 'Each province translation must be a string.',
            'province.*.max'         => 'Each province translation must not exceed 255 characters.',
        ];
    }
}
