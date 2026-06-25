<?php

namespace App\Http\Requests\Frontend;

use App\Http\Requests\AbstractFormRequest;

class CitizenFeedbackRatingRequest extends AbstractFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'rating' => $this->integer('rating'),
            'comment' => filled($this->input('comment'))
                ? trim((string) $this->input('comment'))
                : null,
        ]);
    }

    public function rules(): array
    {
        return [
            'rating' => ['required', 'integer', 'between:1,5'],
            'comment' => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function attributes(): array
    {
        return [
            'rating' => 'Mức độ hài lòng',
            'comment' => 'Ý kiến đánh giá',
        ];
    }
}
