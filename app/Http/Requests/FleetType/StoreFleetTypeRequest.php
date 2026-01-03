<?php

namespace App\Http\Requests\FleetType;

use Illuminate\Foundation\Http\FormRequest;

class StoreFleetTypeRequest extends FormRequest
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
        return [
            'name' => 'required|string|max:255|unique:fleet_types,name',
            'status' => 'required|string|in:active,inactive',
        ];
    }
}
