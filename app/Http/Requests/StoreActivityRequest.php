<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreActivityRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $activityId = $this->route('activity') ? $this->route('activity')->id : null;

        return [
            'activity_code' => 'required|unique:activities,activity_code,'.($activityId ?? ''),
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric',
            'location' => 'required|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ];
    }

    /**
     * Get the custom messages for the validator.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'activity_code.required' => 'The activity code is required.',
            'activity_code.unique' => 'The activity code must be unique.',
            'name.required' => 'The name is required.',
            'description.required' => 'The description is required.',
            'price.required' => 'The price is required.',
            'price.numeric' => 'The price must be a number.',
            'location.required' => 'The location is required.',
            'start_date.required' => 'The start date is required.',
            'end_date.required' => 'The end date is required.',
            'end_date.after_or_equal' => 'The end date must be the same or after the start date.',
        ];
    }
}
