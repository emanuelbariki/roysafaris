<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSystemModuleRequest extends FormRequest
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
        $systemModuleId = $this->route('system_module')->id;

        return [
            'slug' => ['required', 'string', 'max:255', 'unique:system_modules,slug,'.$systemModuleId, 'regex:/^[a-z0-9_-]+$/'],
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
            'slug.required' => 'The module name is required.',
            'slug.unique' => 'This module name already exists.',
            'slug.regex' => 'The module name must only contain lowercase letters, numbers, hyphens, and underscores.',
        ];
    }
}
