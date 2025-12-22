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
            'title'         => ['required', 'string', 'max:255'],
            'sub_title'     => ['required', 'string', 'max:255'],
            'description'   => ['required', 'string'],

            'github_url'    => ['nullable', 'url', 'max:255'],
            'facebook_url'  => ['nullable', 'url', 'max:255'],
            'instagram_url' => ['nullable', 'url', 'max:255'],
            'linkedin_url'  => ['nullable', 'url', 'max:255'],
            'pinterest_url' => ['nullable', 'url', 'max:255'],
            'medium_url'    => ['nullable', 'url', 'max:255'],
            'dribble_url'   => ['nullable', 'url', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'       => 'The hero title is required.',
            'title.string'       => 'The hero title must be a valid text value.',
            'title.max'          => 'The hero title may not be greater than 255 characters.',

            'sub_title.required'   => 'The hero sub title is required.',
            'sub_title.string'   => 'The hero subtitle must be a valid text value.',
            'sub_title.max'      => 'The hero subtitle may not be greater than 255 characters.',

            'description.required' => 'The hero description field is required.',
            'description.string' => 'The description must be a valid text value.',

            'github_url.url'     => 'Please enter a valid GitHub URL (e.g., https://github.com/username).',
            'github_url.max'     => 'The GitHub URL may not be greater than 255 characters.',

            'facebook_url.url'   => 'Please enter a valid Facebook URL (e.g., https://facebook.com/username).',
            'facebook_url.max'   => 'The Facebook URL may not be greater than 255 characters.',

            'instagram_url.url'  => 'Please enter a valid Instagram URL (e.g., https://instagram.com/username).',
            'instagram_url.max'  => 'The Instagram URL may not be greater than 255 characters.',

            'linkedin_url.url'   => 'Please enter a valid LinkedIn URL (e.g., https://linkedin.com/in/username).',
            'linkedin_url.max'   => 'The LinkedIn URL may not be greater than 255 characters.',

            'pinterest_url.url'  => 'Please enter a valid Pinterest URL (e.g., https://pinterest.com/username).',
            'pinterest_url.max'  => 'The Pinterest URL may not be greater than 255 characters.',

            'medium_url.url'     => 'Please enter a valid Medium URL (e.g., https://medium.com/@username).',
            'medium_url.max'     => 'The Medium URL may not be greater than 255 characters.',

            'dribble_url.url'    => 'Please enter a valid Dribbble URL (e.g., https://dribbble.com/username).',
            'dribble_url.max'    => 'The Dribbble URL may not be greater than 255 characters.',
        ];
    }

}
