<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HotelChainRequest extends FormRequest
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
            'code' => 'nullable|string|max:255|unique:hotel_chains,code,' . $this->route('hotelchain'),
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:255',
            'bank_name' => 'nullable|string|max:255',
            'bank_no' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:255',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The hotel chain name is required.',
            'code.required' => 'The hotel chain code is required.',
            'code.unique' => 'This code is already in use.',
            'email.email' => 'Please enter a valid email address.',
        ];
    }
}
