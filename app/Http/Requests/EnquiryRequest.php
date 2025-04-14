<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnquiryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'mobile' => 'nullable|string|max:20',
            'country_id' => 'required|string|max:100',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'arrival_date' => 'nullable|date',
            'departure_date' => 'required|date|after:arrival_date',
            'flexible_dates' => 'nullable|string|in:yes,no',
            'adults' => 'required|integer|min:1',
            'children' => 'nullable|integer|min:0',
            'infants' => 'nullable|integer|min:0',
            'juniors' => 'nullable|integer|min:0',
            'special_interests' => 'nullable|string|max:500',
            'budget_range' => 'nullable|string|max:50',
            'referral_source' => 'required|string|max:100',
            'comments' => 'nullable|string|max:500',
            'status' => 'required|string|in:enquiry,followup,confirmed,cancelled',
        ];
    }
}