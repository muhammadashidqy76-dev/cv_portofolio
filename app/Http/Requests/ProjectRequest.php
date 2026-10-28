<?php

namespace App\Http\Requests;

use App\Models\Project;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Prepare data for validation: handle backward compatibility with legacy payloads
     */
    protected function prepareForValidation(): void
    {
        // 1. Backward compatibility for legacy 'title' -> 'title_id' & 'title_en'
        if ($this->has('title') && !$this->has('title_id')) {
            $this->merge(['title_id' => $this->input('title')]);
        }
        if ($this->filled('title_id') && !$this->filled('title_en')) {
            $this->merge(['title_en' => $this->input('title_id')]);
        }

        // 2. Backward compatibility for 'problem_statement' -> 'problem_statement_id' & 'problem_statement_en'
        if ($this->has('problem_statement') && !$this->has('problem_statement_id')) {
            $this->merge(['problem_statement_id' => $this->input('problem_statement')]);
        }
        if ($this->filled('problem_statement_id') && !$this->filled('problem_statement_en')) {
            $this->merge(['problem_statement_en' => $this->input('problem_statement_id')]);
        }

        // 3. Backward compatibility for 'architecture_decision_summary' -> 'architecture_details_id'
        if ($this->has('architecture_decision_summary') && !$this->has('architecture_details_id')) {
            $this->merge(['architecture_details_id' => $this->input('architecture_decision_summary')]);
        }
        if ($this->filled('architecture_details_id') && !$this->filled('architecture_details_en')) {
            $this->merge(['architecture_details_en' => $this->input('architecture_details_id')]);
        }

        // 4. Auto-generate slug if left empty
        if (!$this->filled('slug') && $this->filled('title_id')) {
            $this->merge(['slug' => Str::slug($this->input('title_id'))]);
        }
    }

    public function rules(): array
    {
        $projectId = null;
        try {
            $routeParam = $this->route('project') ?? $this->route('projects') ?? $this->get('id') ?? $this->project;
            $projectId = $routeParam instanceof Project ? $routeParam->id : $routeParam;
        } catch (\Throwable $e) {
            $projectId = null;
        }

        return [
            'title_id' => ['required', 'string', 'max:255'],
            'title_en' => ['nullable', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('projects', 'slug')->ignore($projectId)],
            'complexity_order' => ['required', 'integer', 'min:1', 'max:100'],
            'problem_statement_id' => ['required', 'string'],
            'problem_statement_en' => ['nullable', 'string'],
            'architecture_details_id' => ['nullable', 'string'],
            'architecture_details_en' => ['nullable', 'string'],
            'impact_metric' => ['nullable', 'string', 'max:255'],
            'preview_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,svg', 'max:4096'],
            'preview_image_path' => ['nullable', 'string', 'max:500'],
            'demo_url' => ['nullable', 'url', 'max:500'],
            'status' => ['required', 'string', Rule::in(['draft', 'published'])],
            'tech_stack_items' => ['nullable', 'array'],
            'tech_stack_items.*' => ['integer', 'exists:tech_stack_items,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'title_id.required' => 'Judul proyek wajib diisi.',
            'slug.required' => 'Slug URL wajib diisi.',
            'slug.unique' => 'Slug URL ini sudah digunakan oleh proyek lain.',
            'complexity_order.required' => 'Urutan kompleksitas wajib ditentukan.',
            'complexity_order.integer' => 'Urutan kompleksitas harus berupa angka bulat positif.',
            'problem_statement_id.required' => 'Problem statement wajib diisi.',
            'preview_image.image' => 'File thumbnail harus berupa gambar.',
            'preview_image.max' => 'Ukuran file thumbnail maksimal 4MB.',
            'demo_url.url' => 'Format Demo URL harus berupa URL yang valid (misal: https://...).',
            'status.required' => 'Status publikasi wajib dipilih.',
            'status.in' => 'Status publikasi harus draft atau published.',
        ];
    }
}
