<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\AbstractFormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProcedureGroupRequest extends AbstractFormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->hasPermissionTo('procedures.manage') ?? false;
    }

    protected function prepareForValidation(): void
    {
        $name = trim((string) $this->input('name'));
        $slug = trim((string) $this->input('slug'));

        $this->merge([
            'name' => $name,
            'slug' => filled($slug) ? Str::slug($slug) : Str::slug($name),
            'sort_order' => $this->input('sort_order', 0),
            'is_active' => $this->boolean('is_active'),
        ]);
    }

    public function rules(): array
    {
        $groupId = $this->route('procedure_group')?->id;

        return [
            'name' => ['required', 'string', 'max:255'],
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('procedure_groups', 'slug')->ignore($groupId),
            ],
            'description' => ['nullable', 'string'],
            'sort_order' => ['required', 'integer', 'min:0'],
            'is_active' => ['required', 'boolean'],
        ];
    }
}
