<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\AbstractFormRequest;
use App\Models\CitizenFeedback;
use Illuminate\Validation\Rule;

class CitizenFeedbackUpdateRequest extends AbstractFormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->hasPermissionTo('feedbacks.manage') ?? false;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'assigned_to' => $this->input('assigned_to') ?: null,
            'admin_response' => filled($this->input('admin_response'))
                ? trim((string) $this->input('admin_response'))
                : null,
            'internal_note' => filled($this->input('internal_note'))
                ? trim((string) $this->input('internal_note'))
                : null,
            'status_public_note' => filled($this->input('status_public_note'))
                ? trim((string) $this->input('status_public_note'))
                : null,
            'status_internal_note' => filled($this->input('status_internal_note'))
                ? trim((string) $this->input('status_internal_note'))
                : null,
        ]);
    }

    public function rules(): array
    {
        return [
            'status' => ['required', Rule::in(array_keys(CitizenFeedback::STATUSES))],
            'assigned_to' => ['nullable', 'integer', Rule::exists('users', 'id')],
            'admin_response' => ['nullable', 'string', 'max:10000'],
            'internal_note' => ['nullable', 'string', 'max:10000'],
            'status_public_note' => ['nullable', 'string', 'max:2000'],
            'status_internal_note' => ['nullable', 'string', 'max:2000'],
        ];
    }

    public function attributes(): array
    {
        return [
            'status' => 'Trạng thái',
            'assigned_to' => 'Cán bộ phụ trách',
            'admin_response' => 'Nội dung phản hồi cho người dân',
            'internal_note' => 'Ghi chú nội bộ',
            'status_public_note' => 'Ghi chú công khai của lần cập nhật',
            'status_internal_note' => 'Ghi chú nội bộ của lần cập nhật',
        ];
    }
}
