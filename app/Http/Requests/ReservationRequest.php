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
            'arrival' => 'required|date',
            'departure' => 'required|date',
            'nights' => 'required|integer',
            'adults' => 'required|integer',
            'lodge_id' => 'required|integer',
            'country_id' => 'required|integer',
            'agent_id' => 'required|integer',
            'children' => 'nullable|integer',
            'juniors' => 'nullable|integer',
            'infants' => 'nullable|integer',
            'status' => 'required|string',
        ];
    }
}
