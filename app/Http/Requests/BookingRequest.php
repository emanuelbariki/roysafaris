<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $nationalityValues = array_column(\App\Enums\Nationality::cases(), 'value');

        return [
            'ref' => 'nullable|string|max:255',
            'group_name' => 'required|string|max:255',
            'nationality' => 'nullable|string|in:' . implode(',', $nationalityValues),
            'remarks' => 'nullable|string|max:1000',
            'file_owner' => 'nullable|string|max:255',
            'channel_id' => 'nullable|integer|exists:channels,id',
            'agent_code' => 'nullable|string|max:255',
            'booking_code' => 'required|string|max:255',
            'arrival_date' => 'required|date',
            'pickup_details' => 'nullable|string|max:255',
            'departure_date' => 'required|date|after_or_equal:arrival_date',
            'drop_details' => 'nullable|string|max:255',
            'adults' => 'nullable|integer|min:0',
            'children' => 'nullable|integer|min:0',
            'infants' => 'nullable|integer|min:0',
            'rooms' => 'nullable|integer|min:0',
            'services' => 'required|array|min:1',
            'services.*' => 'string|in:accommodation,flight,transfers,restaurant,balloon,mountain,vehicle hire,activities',
            'notes' => 'nullable|string|max:2000',
        ];
    }

    public function messages(): array
    {
        return [
            'group_name.required' => 'The group name field is required.',
            'booking_code.required' => 'The booking code field is required.',
            'arrival_date.required' => 'The arrival date field is required.',
            'departure_date.required' => 'The departure date field is required.',
            'departure_date.after_or_equal' => 'The departure date must be after or equal to arrival date.',
            'services.required' => 'Please select at least one service.',
            'services.min' => 'Please select at least one service.',
        ];
    }
}
