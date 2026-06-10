<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\AbstractFormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class DocumentRequest extends AbstractFormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->hasPermissionTo('documents.manage') ?? false;
    }

    protected function prepareForValidation(): void
    {
        $slug = (string) $this->input('slug');

        $this->merge([
            'slug' => filled($slug) ? Str::slug($slug) : null,
            'is_featured' => $this->boolean('is_featured'),
            'is_active' => $this->boolean('is_active'),
        ]);
    }

    public function rules(): array
    {
        $documentId = $this->route('document')?->id;

        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('documents', 'slug')->ignore($documentId),
            ],
            'document_category_id' => [
                'required',
                'integer',
                Rule::exists('document_categories', 'id'),
            ],
            'code' => ['nullable', 'string', 'max:100'],
            'issuer' => ['nullable', 'string', 'max:255'],
            'issued_at' => ['nullable', 'date'],
            'effective_at' => ['nullable', 'date'],
            'summary' => ['nullable', 'string'],
            'file' => [
                'nullable',
                'file',
                'mimes:pdf,doc,docx,xls,xlsx',
                'max:10240',
            ],
            'is_featured' => ['required', 'boolean'],
            'is_active' => ['required', 'boolean'],
        ];
    }
}
