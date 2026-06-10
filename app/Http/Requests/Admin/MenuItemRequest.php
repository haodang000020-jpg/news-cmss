<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\AbstractFormRequest;
use Illuminate\Validation\Rule;

class MenuItemRequest extends AbstractFormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->hasPermissionTo('menus.manage') ?? false;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'parent_id' => $this->input('parent_id') ?: null,
            'route_params' => $this->input('route_params') ?: null,
            'sort_order' => $this->input('sort_order', 0),
            'is_active' => $this->boolean('is_active'),
        ]);
    }

    public function rules(): array
    {
        $menu = $this->route('menu');
        $itemId = $this->route('item')?->id;

        return [
            'parent_id' => [
                'nullable',
                'integer',
                Rule::exists('menu_items', 'id')
                    ->where('menu_id', $menu->id)
                    ->whereNull('parent_id'),
                Rule::notIn(array_filter([$itemId])),
            ],
            'title' => ['required', 'string', 'max:255'],
            'url' => ['nullable', 'string', 'max:255'],
            'route_name' => ['nullable', 'string', 'max:255'],
            'route_params' => ['nullable', 'json'],
            'target' => ['required', Rule::in(['_self', '_blank'])],
            'sort_order' => ['required', 'integer'],
            'is_active' => ['required', 'boolean'],
        ];
    }
}
