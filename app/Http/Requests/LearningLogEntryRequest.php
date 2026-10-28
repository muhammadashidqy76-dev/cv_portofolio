<?php

namespace App\Http\Requests;

use App\Models\LearningLogEntry;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class LearningLogEntryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Prepare data before validation.
     */
    protected function prepareForValidation(): void
    {
        // Auto-generate slug from title if empty
        $slug = $this->filled('slug')
            ? Str::slug($this->input('slug'))
            : Str::slug($this->input('title'));

        // If content (excerpt) is empty but body is filled, auto-generate excerpt
        $content = $this->input('content');
        if (empty(trim((string) $content)) && $this->filled('body')) {
            $stripped = strip_tags((string) $this->input('body'));
            $clean = preg_replace('/\s+/', ' ', $stripped);
            $content = Str::limit(trim($clean), 180);
        }

        // If published_at is empty and status is published, default to today
        $publishedAt = $this->input('published_at');
        if (empty($publishedAt) && $this->input('status') === 'published') {
            $publishedAt = now()->toDateString();
        }

        $this->merge([
            'slug'         => $slug,
            'content'      => $content,
            'published_at' => $publishedAt,
        ]);
    }

    public function rules(): array
    {
        $entryId = $this->route('learningLogEntry') instanceof LearningLogEntry
            ? $this->route('learningLogEntry')->id
            : ($this->route('learningLogEntry') ?? null);

        // If binding by slug, resolve id if needed
        if (is_string($entryId) && !is_numeric($entryId)) {
            $resolved = LearningLogEntry::where('slug', $entryId)->first();
            $entryId = $resolved?->id;
        }

        return [
            'title'              => ['required', 'string', 'max:255'],
            'slug'               => [
                'required',
                'string',
                'max:255',
                Rule::unique('learning_log_entries', 'slug')->ignore($entryId),
            ],
            'content'            => ['nullable', 'string'],
            'body'               => ['nullable', 'string'],
            'tag'                => [
                'required',
                'string',
                Rule::in([
                    LearningLogEntry::TAG_EXPLORING,
                    LearningLogEntry::TAG_PRODUCTION_READY,
                ]),
            ],
            'category'           => [
                'required',
                'string',
                Rule::in([
                    LearningLogEntry::CATEGORY_LARAVEL,
                    LearningLogEntry::CATEGORY_CLOUD,
                ]),
            ],
            'related_project_id' => ['nullable', 'integer', 'exists:projects,id'],
            'published_at'       => ['nullable', 'date'],
            'status'             => ['required', 'string', Rule::in(['draft', 'published'])],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'    => 'Judul artikel catatan teknis wajib diisi.',
            'slug.required'     => 'Slug URL wajib diisi.',
            'slug.unique'       => 'Slug URL ini sudah digunakan oleh artikel lain. Gunakan slug yang berbeda.',
            'tag.required'      => 'Status tag kesiapan wajib dipilih (Production-Ready atau Exploring).',
            'category.required' => 'Pilar kategori wajib ditentukan (Laravel Backend atau Cloud Engineering).',
            'status.required'   => 'Status publikasi wajib dipilih (Published atau Draft).',
            'related_project_id.exists' => 'Proyek portofolio yang dipilih tidak ditemukan.',
        ];
    }
}
