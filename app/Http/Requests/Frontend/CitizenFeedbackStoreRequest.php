<?php

namespace App\Http\Requests\Frontend;

use App\Http\Requests\AbstractFormRequest;
use Illuminate\Validation\Rule;

class CitizenFeedbackStoreRequest extends AbstractFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $phone = preg_replace('/[^0-9+]/', '', (string) $this->input('phone'));

        if (str_starts_with($phone, '+84')) {
            $phone = '0'.substr($phone, 3);
        } elseif (str_starts_with($phone, '84')) {
            $phone = '0'.substr($phone, 2);
        }

        $this->merge([
            'full_name' => trim((string) $this->input('full_name')),
            'phone' => $phone,
            'email' => filled($this->input('email'))
                ? mb_strtolower(trim((string) $this->input('email')))
                : null,
            'address' => filled($this->input('address'))
                ? trim((string) $this->input('address'))
                : null,
            'location' => filled($this->input('location'))
                ? trim((string) $this->input('location'))
                : null,
            'subject' => trim((string) $this->input('subject')),
            'content' => trim((string) $this->input('content')),
        ]);
    }

    public function rules(): array
    {
        return [
            'feedback_category_id' => [
                'required',
                'integer',
                Rule::exists('feedback_categories', 'id')
                    ->where('is_active', true),
            ],
            'full_name' => ['required', 'string', 'min:2', 'max:150'],
            'phone' => [
                'required',
                'string',
                'max:20',
                'regex:/^0\d{9,10}$/',
            ],
            'email' => ['nullable', 'email:rfc', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'subject' => ['required', 'string', 'min:5', 'max:255'],
            'content' => ['required', 'string', 'min:20', 'max:10000'],
            'attachments' => ['nullable', 'array', 'max:5'],
            'attachments.*' => [
                'file',
                'mimes:jpg,jpeg,png,webp,pdf,doc,docx',
                'max:5120',
            ],
            'agree_privacy' => ['accepted'],
            'website' => ['prohibited'],
        ];
    }

    public function messages(): array
    {
        return [
            'phone.regex' => 'Số điện thoại chưa đúng định dạng Việt Nam.',
            'content.min' => 'Nội dung phản ánh cần có ít nhất 20 ký tự.',
            'attachments.max' => 'Chỉ được đính kèm tối đa 5 tệp.',
            'attachments.*.mimes' => 'Tệp đính kèm chỉ nhận ảnh, PDF, DOC hoặc DOCX.',
            'attachments.*.max' => 'Mỗi tệp đính kèm không được vượt quá 5 MB.',
            'agree_privacy.accepted' => 'Bạn cần đồng ý với nội dung xác nhận trước khi gửi.',
        ];
    }

    public function attributes(): array
    {
        return [
            'feedback_category_id' => 'Lĩnh vực phản ánh',
            'full_name' => 'Họ và tên',
            'phone' => 'Số điện thoại',
            'email' => 'Email',
            'address' => 'Địa chỉ liên hệ',
            'location' => 'Địa điểm xảy ra sự việc',
            'subject' => 'Tiêu đề phản ánh',
            'content' => 'Nội dung phản ánh',
            'attachments' => 'Tệp đính kèm',
        ];
    }
}
