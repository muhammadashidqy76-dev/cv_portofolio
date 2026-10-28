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

    /**
     * Prepare inputs before validation.
     */
    protected function prepareForValidation(): void
    {
        if (!$this->filled('display_order')) {
            $this->merge(['display_order' => 0]);
        }
    }

    public function rules(): array
    {
        return [
            'course_name'           => ['required', 'string', 'max:255'],
            'credential_type'       => [
                'required',
                'string',
                Rule::in([
                    JourneyEntry::TYPE_COURSE,
                    JourneyEntry::TYPE_CERTIFICATION,
                    JourneyEntry::TYPE_DIPLOMA,
                ]),
            ],
            'source'                => ['nullable', 'string', 'max:255'],
            'learned'               => ['nullable', 'string'],
            'applied_project_id'    => ['nullable', 'integer', 'exists:projects,id'],
            'result'                => ['nullable', 'string'],
            'certificate_file'      => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
            'certificate_file_path' => ['nullable', 'string', 'max:255'],
            'verification_url'      => ['nullable', 'string', 'url', 'max:255'],
            'completed_at'          => ['nullable', 'date'],
            'display_order'         => ['required', 'integer', 'min:0', 'max:9999'],
            'status'                => ['required', 'string', Rule::in(['draft', 'published'])],
        ];
    }

    public function messages(): array
    {
        return [
            'course_name.required'     => 'Nama kursus atau kredensial sertifikasi wajib diisi.',
            'credential_type.required' => 'Jenis kredensial wajib ditentukan (Course, Certification, atau Diploma).',
            'credential_type.in'       => 'Jenis kredensial tidak valid.',
            'applied_project_id.exists'=> 'Proyek yang dipilih tidak ditemukan dalam database.',
            'certificate_file.mimes'   => 'Berkas sertifikat harus berformat PDF, JPG, JPEG, atau PNG.',
            'certificate_file.max'     => 'Ukuran berkas sertifikat tidak boleh melebihi 5 MB.',
            'verification_url.url'     => 'Format tautan verifikasi kredensial harus berupa URL yang valid (mis. https://...).',
            'display_order.required'   => 'Urutan tampilan wajib diisi angka.',
            'status.required'          => 'Status publikasi wajib dipilih (Published atau Draft).',
        ];
    }
}
