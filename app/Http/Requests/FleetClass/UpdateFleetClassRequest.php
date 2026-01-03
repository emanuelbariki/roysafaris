<?php

namespace App\Http\Requests\FleetClass;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateFleetClassRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $fleetClassId = $this->route('classes')?->id ?? $this->route('classes');

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('fleet_classes', 'name')->ignore($fleetClassId),
            ],
            'status' => 'required|string|in:active,inactive',
        ];
    }
}
