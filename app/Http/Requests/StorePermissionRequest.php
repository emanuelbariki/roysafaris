<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePermissionRequest extends FormRequest
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
            'system_module_id' => ['required', 'exists:system_modules,id'],
            'ability' => ['required', 'string', 'max:255', 'unique:permissions,ability'],
            'description' => ['nullable', 'string', 'max:500'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'system_module_id.required' => 'The module field is required.',
            'system_module_id.exists' => 'The selected module is invalid.',
            'ability.required' => 'The ability name is required.',
            'ability.unique' => 'This ability already exists.',
        ];
    }
}
