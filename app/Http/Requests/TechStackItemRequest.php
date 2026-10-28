<?php

namespace App\Http\Requests;

use App\Models\TechStackItem;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TechStackItemRequest extends FormRequest
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
        if (!$this->filled('display_order')) {
            $this->merge(['display_order' => 0]);
        }

        // Support custom category input if 'category' is set to '__custom'
        if ($this->input('category') === '__custom' && $this->filled('custom_category')) {
            $this->merge(['category' => trim($this->input('custom_category'))]);
        }
    }

    public function rules(): array
    {
        return [
            'name'            => ['required', 'string', 'max:255'],
            'category'        => ['required', 'string', 'max:255'],
            'custom_category' => ['nullable', 'string', 'max:255'],
            'display_order'   => ['required', 'integer', 'min:0', 'max:9999'],
            'status'          => ['required', 'string', Rule::in([
                TechStackItem::STATUS_FINISHED,
                TechStackItem::STATUS_IN_PROGRESS,
                TechStackItem::STATUS_NOT_STARTED,
            ])],
            'project_ids'     => ['nullable', 'array'],
            'project_ids.*'   => ['integer', 'exists:projects,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'          => 'Nama teknologi wajib diisi (mis. Laravel, Redis, Docker).',
            'category.required'      => 'Kategori teknologi wajib ditentukan.',
            'display_order.required' => 'Urutan tampilan wajib diisi berupa angka.',
            'status.required'        => 'Status penguasaan teknologi wajib dipilih.',
            'status.in'              => 'Status harus salah satu dari: Finished, In Progress, atau Not Started.',
        ];
    }
}
