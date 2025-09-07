<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSendContactRequest extends FormRequest
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
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10',
            'name'    => 'nullable|string|max:100',
            'email'   => 'required|email|max:255',
            'phone'   => 'nullable|max:20|min:10',
        ];
    }
    public function messages(): array
    {
        return [
            'subject.required' => 'The subject is required.',
            'subject.string'   => 'The subject must be a valid string.',
            'subject.max'      => 'The subject may not be greater than 255 characters.',

            'message.required' => 'The message is required.',
            'message.string'   => 'The message must be a valid string.',
            'message.min'      => 'The message must be at least 10 characters long.',

            'name.string'      => 'The name must be a valid string.',
            'name.max'         => 'The name may not be greater than 100 characters.',

            'email.required'   => 'The email address is required.',
            'email.email'      => 'Please enter a valid email address.',
            'email.max'        => 'The email may not be greater than 255 characters.',

            'phone.max'        => 'The phone number may not be greater than 20 digits.',
            'phone.min'        => 'The phone number must be at least 10 digits.',
        ];
    }
}
