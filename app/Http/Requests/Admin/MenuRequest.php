<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\AbstractFormRequest;
use Illuminate\Validation\Rule;

class MenuRequest extends AbstractFormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->hasPermissionTo('menus.manage') ?? false;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_active' => $this->boolean('is_active'),
        ]);
    }

    public function rules(): array
    {
        $menuId = $this->route('menu')?->id;

        return [
            'name' => ['required', 'string', 'max:255'],
            'location' => [
                'required',
                'string',
                'max:100',
                Rule::unique('menus', 'location')->ignore($menuId),
            ],
            'is_active' => ['required', 'boolean'],
        ];
    }
}
