<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePhoneRequest extends FormRequest
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
        // Get phone ID from the route (null on create)
        $phoneId = $this->route('phone');

        return [
            'contact_id' => ['required', 'exists:contacts,id'],
            'phone_number' => [
                'required',
                'string',
                'max:20',
                Rule::unique('phones', 'phone_number')->ignore($phoneId),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'contact_id.required' => 'The contact field is required.',
            'contact_id.exists'   => 'The selected contact is invalid.',

            'phone_number.required' => 'The phone number field is required.',
            'phone_number.string'   => 'The phone number must be a valid string.',
            'phone_number.max'      => 'The phone number may not exceed 20 characters.',
            'phone_number.unique'   => 'This phone number is already registered.',
        ];
    }
}
