<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\AbstractFormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class DocumentCategoryRequest extends AbstractFormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->hasPermissionTo('documents.manage') ?? false;
    }

    protected function prepareForValidation(): void
    {
        $name = (string) $this->input('name');
        $slug = (string) $this->input('slug');

        $this->merge([
            'slug' => filled($slug) ? Str::slug($slug) : Str::slug($name),
            'sort_order' => $this->input('sort_order', 0),
            'is_active' => $this->boolean('is_active'),
        ]);
    }

    public function rules(): array
    {
        $documentCategoryId = $this->route('document_category')?->id;

        return [
            'name' => ['required', 'string', 'max:255'],
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('document_categories', 'slug')->ignore($documentCategoryId),
            ],
            'description' => ['nullable', 'string'],
            'sort_order' => ['required', 'integer'],
            'is_active' => ['required', 'boolean'],
        ];
    }
}
