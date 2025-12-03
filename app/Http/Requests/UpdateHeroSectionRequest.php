<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHeroSectionRequest extends FormRequest
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
            'title'            => ['nullable', 'string', 'max:255'],
            'sub_title'        => ['nullable', 'string', 'max:255'],
            'description'      => ['nullable', 'string'],
            'image'            => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'], // 2MB
            'pdf'              => ['nullable', 'mimes:pdf', 'max:5120'], // 5MB
            'button_text'      => ['nullable', 'string', 'max:255'],
            'button_url'       => ['nullable', 'string', 'max:255'],
            'button_text_two'  => ['nullable', 'string', 'max:255'],
            'button_url_two'   => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'image.image' => 'Hero image অবশ্যই ইমেজ ফাইল হতে হবে।',
            'image.mimes' => 'Hero image just jpg, jpeg, png, webp হতে পারবে।',
            'pdf.mimes'   => 'PDF ফাইল শুধুমাত্র .pdf ফর্ম্যাট হতে পারবে।',
        ];
    }
}
