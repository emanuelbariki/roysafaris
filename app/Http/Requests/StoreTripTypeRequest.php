<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTripTypeRequest extends FormRequest
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
        $tripTypeId = $this->route('id');

        return [
            'id' => 'sometimes|exists:trip_types,id',
            'name' => 'required|string|max:255|unique:trip_types,name,'.$tripTypeId,
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
            'name.required' => 'The trip type name is required.',
            'name.unique' => 'This trip type name already exists.',
            'name.max' => 'The trip type name must not exceed 255 characters.',
            'status.required' => 'The status is required.',
            'status.in' => 'The status must be either active or inactive.',
        ];
    }
}
