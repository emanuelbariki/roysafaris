<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentRequest extends FormRequest
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
            'reservation_id'   => ['required', 'exists:reservations,id'],
            'date'             => ['required', 'date'],
            'currency_id'      => ['required', 'exists:currencies,id'],
            'payment_amount'   => ['required', 'numeric', 'min:0'],
            'payment_date'     => ['required', 'string', 'max:100'],
            'payment_mode'     => ['required', 'string', 'max:100'],
            'payment_details'  => ['nullable', 'string', 'max:255'],
        ];
    }
}
