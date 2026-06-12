<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\AbstractFormRequest;

class WorkScheduleRequest extends AbstractFormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->hasPermissionTo('work-schedules.manage') ?? false;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'day_of_week' => $this->input('day_of_week') ?: null,
            'is_working_day' => $this->boolean('is_working_day'),
            'sort_order' => $this->input('sort_order', 0),
            'is_active' => $this->boolean('is_active'),
        ]);
    }

    public function rules(): array
    {
        return [
            'day_of_week' => ['nullable', 'integer', 'between:1,7'],
            'title' => ['nullable', 'string', 'max:255'],
            'morning_time' => ['nullable', 'string', 'max:255'],
            'afternoon_time' => ['nullable', 'string', 'max:255'],
            'note' => ['nullable', 'string'],
            'is_working_day' => ['required', 'boolean'],
            'sort_order' => ['required', 'integer'],
            'is_active' => ['required', 'boolean'],
        ];
    }
}
