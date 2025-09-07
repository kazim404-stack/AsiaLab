<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class UpdateContactRequest extends FormRequest
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
        $contactId = $this->route('contact'); // Get ID from route for update

        return [
            'general_setting_id' => ['required', 'exists:general_settings,id'],
            'province_id' => ['required', 'exists:provinces,id'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('contacts', 'email')->ignore($contactId),
            ],

            // State must be an array with translations


            // Address must be an array with translations
            'address' => ['required', 'array'],
            'address.*' => ['required', 'string', 'max:255'],

            'status' => ['nullable', 'in:0,1'],
        ];
    }

    public function messages(): array
    {
        return [
            'general_setting_id.required' => 'The general setting field is required.',
            'general_setting_id.exists'   => 'The selected general setting is invalid.',


            'province_id.required' => 'The province id field is required.',
            'province_id.exists'   => 'The selected province is invalid.',


            'email.required' => 'The email field is required.',
            'email.email'    => 'Please provide a valid email address.',
            'email.max'      => 'The email may not be greater than 255 characters.',
            'email.unique'   => 'This email is already registered.',

            // State messages


            // Address messages
            'address.required'    => 'The address field is required.',
            'address.array'       => 'The address must be an array of translations.',
            'address.*.required'  => 'Each address translation is required.',
            'address.*.string'    => 'Each address translation must be a string.',
            'address.*.max'       => 'Each address translation must not exceed 255 characters.',

            'status.in' => 'Status must be either 0 (inactive) or 1 (active).',
        ];
    }
}
