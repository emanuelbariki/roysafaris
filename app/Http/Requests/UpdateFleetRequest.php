<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateFleetRequest extends FormRequest
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
        $fleet = $this->route('fleet');

        return [
            'make_model' => 'required|string|max:255',
            'reg_no' => 'required|string|max:255',
            'fleet_type_id' => 'required|exists:fleet_types,id',
            'fleet_class_id' => 'required|exists:fleet_classes,id',
            'seats' => 'required|integer|min:1',
            'purchase_date' => 'required|date',
            'mileage' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
            'fleet_status' => 'sometimes|in:active,inactive',
        ];
    }

    protected function getRedirectUrl(): string
    {
        return route('fleets.index');
    }
}
