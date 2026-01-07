<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCarrierRequest extends FormRequest
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
        $carrierId = $this->route('id');

        return [
            'id' => 'sometimes|exists:carriers,id',
            'name' => 'required|string|max:255|unique:carriers,name,'.$carrierId,
            'carrier_type' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'website' => 'nullable|url|max:255',
            'city_id' => 'nullable|exists:cities,id',
            'country_id' => 'nullable|exists:countries,id',
            'stauts' => 'required|in:active,inactive',
            'bank_name' => 'nullable|string|max:255',
            'bank_no' => 'nullable|string|max:255',
        ];
    }

    /**
     * Get the custom messages for the validator.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The carrier name is required.',
            'name.unique' => 'This carrier name already exists.',
            'name.max' => 'The carrier name must not exceed 255 characters.',
            'carrier_type.required' => 'The carrier type is required.',
            'carrier_type.max' => 'The carrier type must not exceed 255 characters.',
            'email.email' => 'Please provide a valid email address.',
            'email.max' => 'The email must not exceed 255 characters.',
            'phone.max' => 'The phone number must not exceed 20 characters.',
            'website.url' => 'Please provide a valid URL.',
            'website.max' => 'The website must not exceed 255 characters.',
            'city_id.exists' => 'The selected city is invalid.',
            'country_id.exists' => 'The selected country is invalid.',
            'stauts.required' => 'The status is required.',
            'stauts.in' => 'The status must be either active or inactive.',
        ];
    }
}
