<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MountainRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:255|unique:mountains,code,' . $this->route('mountain'),
            'country_id' => 'nullable|string|max:255',
            'city_id' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:255',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The mountain name is required.',
            'code.required' => 'The mountain code is required.',
            'code.unique' => 'This code is already in use.',
        ];
    }
}
