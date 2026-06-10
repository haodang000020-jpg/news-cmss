<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\AbstractFormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ArticleRequest extends AbstractFormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->hasPermissionTo('articles.manage') ?? false;
    }

    protected function prepareForValidation(): void
    {
        $title = (string) $this->input('title');
        $slug = (string) $this->input('slug');

        $this->merge([
            'slug' => filled($slug) ? Str::slug($slug) : Str::slug($title),
            'is_featured' => $this->boolean('is_featured'),
        ]);
    }

    public function rules(): array
    {
        $articleId = $this->route('article')?->id;

        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('articles', 'slug')->ignore($articleId),
            ],
            'category_id' => ['required', 'integer', Rule::exists('categories', 'id')],
            'summary' => ['nullable', 'string'],
            'content' => ['required', 'string'],
            'thumbnail' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'status' => ['required', Rule::in(['draft', 'published'])],
            'is_featured' => ['required', 'boolean'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string'],
        ];
    }
}
