<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class DigitalAssistantSearchRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'question' => trim((string) $this->input('question', '')),
        ]);
    }

    public function rules(): array
    {
        return [
            'question' => [
                'required',
                'string',
                'min:2',
                'max:250',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'question.required' => 'Vui lòng nhập nội dung cần tra cứu.',
            'question.min' => 'Nội dung tra cứu cần có ít nhất 2 ký tự.',
            'question.max' => 'Nội dung tra cứu không được vượt quá 250 ký tự.',
        ];
    }
}
