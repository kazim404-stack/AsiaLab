<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePhoneRequest extends FormRequest
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
            'contact_id' => ['required', 'exists:contacts,id'],
            'phone_number' => [
                'required',
                'string',
                'min:10',
                'max:20',
                'unique:phones,phone_number',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'contact_id.required' => 'The contact field is required.',
            'contact_id.exists'   => 'The selected contact is invalid.',

            'phone_number.required' => 'The phone number field is required.',
            'phone_number.min'      => 'The phone may not be less than 10 characters.',
            'phone_number.max'      => 'The phone may not be greater than 20 characters.',
            'phone_number.unique'   => 'This phone number is already registered.',
        ];
    }
}
