<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceProviderRequest extends FormRequest
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
        $providerId = $this->route('id');

        return [
            'id' => 'sometimes|exists:service_providers,id',
            'name' => 'required|string|max:255|unique:service_providers,name,'.$providerId,
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'website' => 'nullable|url|max:255',
            'address' => 'nullable|string|max:255',
            'city_id' => 'nullable|exists:cities,id',
            'country_id' => 'nullable|exists:countries,id',
            'type' => 'required|string|max:255',
            'bill_to' => 'nullable|string|max:255',
            'status' => 'required|in:active,inactive',
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
            'name.required' => 'The service provider name is required.',
            'name.unique' => 'This service provider name already exists.',
            'name.max' => 'The service provider name must not exceed 255 characters.',
            'email.email' => 'Please provide a valid email address.',
            'email.max' => 'The email must not exceed 255 characters.',
            'phone.max' => 'The phone number must not exceed 20 characters.',
            'website.url' => 'Please provide a valid URL.',
            'website.max' => 'The website must not exceed 255 characters.',
            'type.required' => 'The service provider type is required.',
            'status.required' => 'The status is required.',
            'status.in' => 'The status must be either active or inactive.',
        ];
    }
}
