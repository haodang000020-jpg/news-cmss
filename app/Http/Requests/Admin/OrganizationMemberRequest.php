<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class OrganizationMemberRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_active' => $this->boolean('is_active'),
        ]);
    }

    public function rules(): array
    {
        return [
            'parent_id' => [
                'nullable',
                'integer',
                'exists:organization_members,id',
            ],

            'name' => [
                'required',
                'string',
                'max:150',
            ],

            'position' => [
                'required',
                'string',
                'max:150',
            ],

            'position_level' => [
                'required',
                'integer',
                'between:1,3',
            ],

            'department' => [
                'nullable',
                'string',
                'max:255',
            ],

            'responsibility' => [
                'nullable',
                'string',
                'max:5000',
            ],

            'phone' => [
                'nullable',
                'string',
                'max:30',
            ],

            'email' => [
                'nullable',
                'email',
                'max:255',
            ],

            'photo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:4096',
            ],

            'biography' => [
                'nullable',
                'string',
                'max:10000',
            ],

            'sort_order' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'is_active' => [
                'boolean',
            ],
        ];
    }

    public function attributes(): array
    {
        return [
            'parent_id' => 'Cán bộ quản lý trực tiếp',
            'name' => 'Họ và tên',
            'position' => 'Chức vụ',
            'position_level' => 'Cấp chức vụ',
            'department' => 'Đơn vị',
            'responsibility' => 'Lĩnh vực phụ trách',
            'phone' => 'Số điện thoại',
            'email' => 'Email',
            'photo' => 'Ảnh chân dung',
            'biography' => 'Thông tin giới thiệu',
            'sort_order' => 'Thứ tự hiển thị',
            'is_active' => 'Trạng thái',
        ];
    }

    public function messages(): array
    {
        return [
            'position_level.between' =>
                'Cấp chức vụ chỉ được chọn từ cấp 1 đến cấp 3.',

            'photo.max' =>
                'Ảnh chân dung không được lớn hơn 4 MB.',
        ];
    }
}
