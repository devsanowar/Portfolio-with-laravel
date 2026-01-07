<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTechnologyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Allow all authenticated users (or adjust based on your permissions)
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $technologyId = $this->route('technology'); // The {technology} route parameter

        return [
            'name' => 'required|string|max:255|unique:technologies,name,' . $technologyId,
            'icon_class' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'status' => 'required|in:0,1',
        ];
    }

    /**
     * Custom messages for validation errors.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Technology name is required.',
            'name.unique' => 'This technology name already exists.',
            'status.in' => 'Status must be either Active or Inactive.',
        ];
    }
}
