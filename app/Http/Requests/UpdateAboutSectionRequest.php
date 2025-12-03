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
            'section_title'    => ['nullable', 'string', 'max:255'],
            'section_subtitle' => ['nullable', 'string', 'max:255'],
            'description'      => ['nullable', 'string'],

            'name'             => ['nullable', 'string', 'max:255'],
            'father_name'      => ['nullable', 'string', 'max:255'],
            'mother_name'      => ['nullable', 'string', 'max:255'],

            'date_of_birth'    => ['nullable', 'date'], // you can change to string if necessary
            'Age'              => ['nullable', 'integer', 'min:0', 'max:150'],

            'gender'           => ['nullable', 'in:Male,Female,Other'],

            'email'            => ['nullable', 'email', 'max:255'],
            'phone'            => ['nullable', 'string', 'max:50'],
            'address'          => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'section_title.max'    => 'Section title may not be greater than 255 characters.',
            'section_subtitle.max' => 'Section subtitle may not be greater than 255 characters.',

            'name.max'             => 'Name may not be greater than 255 characters.',
            'father_name.max'      => 'Father name may not be greater than 255 characters.',
            'mother_name.max'      => 'Mother name may not be greater than 255 characters.',

            'date_of_birth.date'   => 'Date of birth must be a valid date.',
            'age.integer'          => 'Age must be a valid number.',
            'age.min'              => 'Age must be at least 0.',
            'age.max'              => 'Age may not be greater than 150.',

            'gender.in'            => 'Gender must be Male, Female or Other.',

            'email.email'          => 'Please provide a valid email address.',
            'email.max'            => 'Email may not be greater than 255 characters.',

            'phone.max'            => 'Phone may not be greater than 50 characters.',
            'address.max'          => 'Address may not be greater than 255 characters.',
        ];
    }


    public function attributes(): array
    {
        return [
            'section_title'    => 'section title',
            'section_subtitle' => 'section subtitle',
            'date_of_birth'    => 'date of birth',
            'age'              => 'age',
        ];
    }


}
