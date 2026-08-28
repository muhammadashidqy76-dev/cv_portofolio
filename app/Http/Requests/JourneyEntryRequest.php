<?php

namespace App\Http\Requests;

use App\Models\JourneyEntry;
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
            'credential_type' => [
                'sometimes',
                'required',
                'string',
                Rule::in([
                    JourneyEntry::TYPE_COURSE,
                    JourneyEntry::TYPE_CERTIFICATION,
                    JourneyEntry::TYPE_DIPLOMA,
                ]),
            ],
            'source' => ['nullable', 'string', 'max:255'],
            'learned' => ['nullable', 'string'],
            'applied_project_id' => ['nullable', 'integer', 'exists:projects,id'],
            'result' => ['nullable', 'string'],
            'certificate_file_path' => ['nullable', 'string', 'max:255', 'regex:/\.(jpe?g|png|pdf)$/i'],
            'verification_url' => ['nullable', 'string', 'url', 'max:255'],
            'completed_at' => ['nullable', 'date'],
            'display_order' => ['nullable', 'integer', 'min:0'],
            'status' => ['required', 'string', Rule::in(['draft', 'published'])],
        ];
    }
}
