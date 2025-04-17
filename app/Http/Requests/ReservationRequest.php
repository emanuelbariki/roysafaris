<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
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
            'guest_name' => 'required|string|max:255',
            'agent_id' => 'required|exists:agents,id',
            'country_id' => 'required|exists:countries,id',
            'lodge_id' => 'required|exists:lodges,id',
            'arrival' => 'required|date',
            'departure' => 'required|date|after_or_equal:arrival',
            'nights' => 'required|integer|min:1',
            'total_rooms' => 'nullable|integer|min:1',
            'total_pax' => 'nullable|integer|min:1',
            'adults' => 'required|integer|min:0',
            'children' => 'nullable|integer|min:0',
            'juniors' => 'nullable|integer|min:0',
            'infants' => 'nullable|integer|min:0',
            'day_room' => 'boolean',
            'user_id' => 'required|exists:users,id',
            'booking_date' => 'nullable|date',
            'internal_ref' => 'nullable|string',
            'reservation_code' => 'nullable|string',
            'arrival_time' => 'nullable|string',
            'property_name' => 'nullable|string',
            'booking_code' => 'nullable|string',
            'room_detail' => 'required|array',
            'room_detail.*' => 'integer|exists:rooms,id',
            'guest_notes' => 'nullable|string',
            'internal_remarks' => 'nullable|string',
            'current_version' => 'nullable|string',
            'prior_version' => 'nullable|string',
            'voucher_issue_date' => 'nullable|date',
            'issue_date' => 'nullable|date',
            'payments' => 'nullable|array',
            'payments.*.date' => 'required|date',
            'payments.*.currency_id' => 'required|exists:currencies,id',
            'payments.*.payment_amount' => 'required|numeric',
            'payments.*.payment_date' => 'required|string',
            'payments.*.payment_mode' => 'required|string',
            'payments.*.payment_details' => 'nullable|string',
        ];
    }
}
