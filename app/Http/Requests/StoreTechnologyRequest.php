<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTechnologyRequest extends FormRequest
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
            'service_id' => ['nullable', 'integer', 'exists:services,id'],
            'name' => 'required|string|max:255|unique:technologies,name',
            'icon_class' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'status' => 'required|in:0,1',
        ];
    }

    public function messages(): array
    {
        return [
            'service_id.integer' => 'Please select a valid service.',
            'service_id.exists'  => 'Selected service does not exist. Please choose another service.',
            'name.required' => 'Technology name is required.',
            'name.unique' => 'This technology already exists.',
            'status.in' => 'Status must be either Active or Inactive.',
        ];
    }
}
