<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MountainRouteRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:255|unique:mountain_routes,code,' . $this->route('mountainroute'),
            'description' => 'nullable|string|max:65535',
            'mountain_id' => 'nullable|integer|exists:mountains,id',
            'min_days' => 'nullable|integer|min:1|max:100',
            'max_days' => 'nullable|integer|min:1|max:100',
            'status' => 'nullable|string|max:255',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The route name is required.',
            'code.required' => 'The route code is required.',
            'code.unique' => 'This code is already in use.',
        ];
    }
}
