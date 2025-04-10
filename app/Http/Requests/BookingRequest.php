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
        return [
            'ref' => 'required|string|max:255',
            'group_name' => 'required|string|max:255',
            'nationality' => 'required|string|max:255',
            'remarks' => 'nullable|string|max:1000',
            'file_owner' => 'nullable|string|max:255',
            'agent_code' => 'nullable|string|max:255',
            'booking_code' => 'required|string|max:255',
            'arrival_date' => 'required|date',
            'departure_date' => 'required|date|after_or_equal:arrival_date',
            'pickup_details' => 'nullable|string|max:255',
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
}