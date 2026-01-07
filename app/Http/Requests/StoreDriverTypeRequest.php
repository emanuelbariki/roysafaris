<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDriverTypeRequest extends FormRequest
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
        $driverTypeId = $this->route('drivertype')?->id ?? $this->route('type')?->id;

        return [
            'id' => 'sometimes|exists:driver_types,id',
            'name' => 'required|string|max:255|unique:driver_types,name,'.$driverTypeId,
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
            'name.required' => 'The driver type name is required.',
            'name.unique' => 'This driver type name already exists.',
            'name.max' => 'The driver type name must not exceed 255 characters.',
            'status.required' => 'The status is required.',
            'status.in' => 'The status must be either active or inactive.',
        ];
    }
}
