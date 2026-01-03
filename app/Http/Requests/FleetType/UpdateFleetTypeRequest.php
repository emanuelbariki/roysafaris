<?php

namespace App\Http\Requests\FleetType;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateFleetTypeRequest extends FormRequest
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
        $fleetTypeId = $this->route('type')?->id ?? $this->route('type');

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('fleet_types', 'name')->ignore($fleetTypeId),
            ],
            'status' => 'required|string|in:active,inactive',
        ];
    }
}
