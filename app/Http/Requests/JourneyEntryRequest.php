<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class JourneyEntryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'course_name' => ['required', 'string', 'max:255'],
            'credential_type' => ['sometimes', 'required', 'string', Rule::in(['course', 'certification', 'diploma'])],
            'source' => ['nullable', 'string', 'max:255'],
            'learned' => [
                Rule::requiredIf(fn () => $this->input('credential_type', 'course') === 'course'),
                'nullable',
                'string',
            ],
            'applied_project_id' => ['nullable', 'integer', 'exists:projects,id'],
            'result' => [
                Rule::requiredIf(fn () => $this->input('credential_type', 'course') === 'course'),
                'nullable',
                'string',
            ],
            'certificate_file_path' => [
                Rule::requiredIf(fn () => in_array($this->input('credential_type'), ['certification', 'diploma'], true)),
                'nullable',
                'string',
                'max:255',
            ],
            'verification_url' => ['nullable', 'url', 'max:255'],
            'completed_at' => ['nullable', 'date'],
            'display_order' => ['nullable', 'integer', 'min:0'],
            'status' => ['required', 'string', Rule::in(['draft', 'published'])],
        ];
    }
}
