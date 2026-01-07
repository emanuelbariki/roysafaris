<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDriverRequest extends FormRequest
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
        $driverId = $this->route('driver') ?? $this->route('id') ?? $this->route('type');

        return [
            'id' => 'sometimes|exists:drivers,id',
            'name' => 'required|string|max:255',
            'license_no' => 'required|string|max:255|unique:drivers,license_no,'.$driverId,
            'driver_type_id' => 'required|exists:driver_types,id',
            'fleet_id' => 'nullable|exists:fleets,id',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|unique:drivers,email,'.$driverId,
            'status' => 'required|in:active,inactive',
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
            'name.required' => 'The driver name is required.',
            'name.max' => 'The driver name must not exceed 255 characters.',
            'license_no.required' => 'The license number is required.',
            'license_no.unique' => 'This license number is already in use.',
            'driver_type_id.required' => 'The driver type is required.',
            'driver_type_id.exists' => 'The selected driver type is invalid.',
            'fleet_id.exists' => 'The selected fleet is invalid.',
            'email.email' => 'Please provide a valid email address.',
            'email.unique' => 'This email address is already in use.',
            'status.required' => 'The status is required.',
            'status.in' => 'The status must be either active or inactive.',
        ];
    }
}
