<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVehicleTypeRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'seating' => 'nullable|integer',
            'transmission' => 'nullable|string',
            'drive' => 'nullable|string',
            'fuel' => 'nullable|string',
            'ac' => 'nullable|boolean',
            'rate' => 'nullable|numeric',
            'status' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'insurance_doc' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'registration_doc' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'available_from' => 'nullable|date',
            'available_until' => 'nullable|date|after_or_equal:available_from',
        ];
    }
}
