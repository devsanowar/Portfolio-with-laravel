<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class SkillCategoryStoreRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'icon'  => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'sort_order'  => ['nullable', 'integer', 'min:0'],
            'status'      => ['required', Rule::in([0, 1, '0', '1'])],
        ];
    }

    public function attributes(): array
    {
        return [
            'title'       => 'category title',
            'icon'        => 'icon',
            'description' => 'description',
            'sort_order'  => 'sort order',
            'status'      => 'status',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'status' => $this->status ?? 0,
            'sort_order' => $this->sort_order ?? 0,
        ]);
    }
}
