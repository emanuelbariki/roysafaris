<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccommodationRequest extends FormRequest
{
    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        // If data is nested under 'accommodation', extract it to root level
        if ($this->has('accommodation')) {
            $this->merge($this->input('accommodation'));
        }
    }

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
        $ignoreId = $this->route('accommodation')?->id;

        return [
            'name' => 'required|string|max:255',
            'code' => $ignoreId
                ? 'nullable|string|max:255|unique:accommodations,code,' . $ignoreId
                : 'nullable|string|max:255|unique:accommodations,code',
            'hotel_chain_id' => 'nullable',
            'accommodations_type_id' => 'nullable',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'website' => 'nullable|url|max:255',
            'camping_logistics' => 'nullable|string|max:65535',
            'balloon_pickup' => 'nullable|string|max:255',
            'voucher_copies' => 'nullable|string|max:255',
            'pay_to' => 'nullable|in:hotel,chain',
            'billing_ccy' => 'nullable|string|max:10',
            'coordinates' => 'nullable|string|max:50',
            'status' => 'nullable|string|max:255',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The accommodation name is required.',
            'code.unique' => 'This code is already in use.',
            'hotel_chain_id.required' => 'Please select a hotel chain.',
            'accommodations_type_id.required' => 'Please select an accommodation type.',
            'email.email' => 'Please enter a valid email address.',
            'website.url' => 'Please enter a valid URL.',
            'pay_to.in' => 'Pay to must be either hotel or chain.',
        ];
    }
}
