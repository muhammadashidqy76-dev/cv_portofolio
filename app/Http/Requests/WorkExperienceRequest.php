<?php

namespace App\Http\Requests;

use App\Models\WorkExperience;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class WorkExperienceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Prepare inputs before validation.
     */
    protected function prepareForValidation(): void
    {
        $isCurrent = $this->boolean('is_current');

        $this->merge([
            'is_current'    => $isCurrent,
            'end_date'      => $isCurrent ? null : $this->input('end_date'),
            'display_order' => $this->filled('display_order') ? (int) $this->input('display_order') : 0,
        ]);
    }

    public function rules(): array
    {
        return [
            'company_name'    => ['required', 'string', 'max:255'],
            'position'        => ['required', 'string', 'max:255'],
            'employment_type' => [
                'required',
                'string',
                Rule::in([
                    WorkExperience::TYPE_INTERNSHIP,
                    WorkExperience::TYPE_FULL_TIME,
                    WorkExperience::TYPE_PART_TIME,
                    WorkExperience::TYPE_FREELANCE,
                ]),
            ],
            'start_date'      => ['required', 'date'],
            'is_current'      => ['sometimes', 'boolean'],
            'end_date'        => [
                'nullable',
                'date',
                'after_or_equal:start_date',
                Rule::requiredIf(fn () => !$this->boolean('is_current')),
            ],
            'description'     => ['nullable', 'string'],
            'location'        => ['nullable', 'string', 'max:255'],
            'display_order'   => ['required', 'integer', 'min:0', 'max:9999'],
            'status'          => [
                'required',
                'string',
                Rule::in([
                    WorkExperience::STATUS_PUBLISHED,
                    WorkExperience::STATUS_DRAFT,
                ]),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'company_name.required'    => 'Nama perusahaan / institusi tempat bekerja wajib diisi.',
            'position.required'        => 'Nama posisi / jabatan wajib diisi.',
            'employment_type.required' => 'Tipe pekerjaan wajib ditentukan.',
            'employment_type.in'       => 'Tipe pekerjaan harus salah satu dari: Internship, Full-time, Part-time, atau Freelance.',
            'start_date.required'      => 'Tanggal mulai bekerja wajib ditentukan.',
            'start_date.date'          => 'Format tanggal mulai bekerja tidak valid.',
            'end_date.required'        => 'Tanggal selesai wajib diisi jika Anda sudah tidak aktif bekerja di tempat ini.',
            'end_date.after_or_equal'  => 'Tanggal selesai tidak boleh lebih awal dari tanggal mulai bekerja.',
            'display_order.required'   => 'Urutan tampilan wajib diisi angka.',
            'status.required'          => 'Status publikasi wajib dipilih (Published atau Draft).',
            'status.in'                => 'Status harus bernilai published atau draft.',
        ];
    }
}
