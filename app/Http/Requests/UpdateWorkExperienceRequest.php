<?php

namespace App\Http\Requests;

use App\Models\WorkExperience;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateWorkExperienceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'company_name' => ['sometimes', 'required', 'string', 'max:255'],
            'position' => ['sometimes', 'required', 'string', 'max:255'],
            'employment_type' => [
                'sometimes',
                'required',
                'string',
                Rule::in([
                    WorkExperience::TYPE_INTERNSHIP,
                    WorkExperience::TYPE_FULL_TIME,
                    WorkExperience::TYPE_PART_TIME,
                    WorkExperience::TYPE_FREELANCE,
                ]),
            ],
            'start_date' => ['sometimes', 'required', 'date'],
            'is_current' => ['sometimes', 'boolean'],
            'end_date' => [
                'nullable',
                'date',
                'after_or_equal:start_date',
                'required_if:is_current,false,0',
            ],
            'description' => ['nullable', 'string'],
            'location' => ['nullable', 'string', 'max:255'],
            'display_order' => ['nullable', 'integer', 'min:0'],
            'status' => [
                'sometimes',
                'required',
                'string',
                Rule::in([
                    WorkExperience::STATUS_PUBLISHED,
                    WorkExperience::STATUS_DRAFT,
                ]),
            ],
        ];
    }
}
