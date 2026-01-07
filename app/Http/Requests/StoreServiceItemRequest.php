<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceItemRequest extends FormRequest
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
        $serviceItemId = $this->route('id');

        return [
            'id' => 'sometimes|exists:service_items,id',
            'name' => 'required|string|max:255|unique:service_items,name,'.$serviceItemId,
            'category' => 'required|in:food,gear,essentials',
            'status' => 'required|in:active,inactive',
        ];
    }

    /**
     * Get the custom messages for the validator.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The service item name is required.',
            'name.unique' => 'This service item name already exists.',
            'name.max' => 'The service item name must not exceed 255 characters.',
            'category.required' => 'The category is required.',
            'category.in' => 'The category must be either food, gear, or essentials.',
            'status.required' => 'The status is required.',
            'status.in' => 'The status must be either active or inactive.',
        ];
    }
}
