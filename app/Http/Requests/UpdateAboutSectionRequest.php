<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAboutSectionRequest extends FormRequest
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
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'experience'  => ['nullable', 'integer', 'min:0'],
            'projects'    => ['nullable', 'integer', 'min:0'],

            'skills'      => ['nullable', 'array'],
            'skills.*'    => ['nullable', 'string', 'max:255'],

            'image'       => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'pdf'         => ['nullable', 'file', 'mimes:pdf', 'max:5120'],
        ];
    }

}
