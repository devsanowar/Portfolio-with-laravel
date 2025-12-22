<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class SkillsStoreRequest extends FormRequest
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
            'skill_category_id' => ['required', 'integer', 'exists:skill_categories,id'],
            'name'              => ['required', 'string', 'max:255'],
            'percentage'        => ['required', 'integer', 'min:0', 'max:100'],
            'sort_order'        => ['nullable', 'integer', 'min:0'],
            'status'      => ['required', Rule::in([0, 1, '0', '1'])],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'sort_order' => $this->sort_order ?? 0,
            'status' => $this->status ?? 0,
        ]);
    }
}
