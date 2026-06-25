<?php

namespace App\Http\Requests\Frontend;

use App\Http\Requests\AbstractFormRequest;

class CitizenFeedbackLookupRequest extends AbstractFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $contact = trim((string) $this->input('contact'));

        if (str_contains($contact, '@')) {
            $contact = mb_strtolower($contact);
        } else {
            $contact = preg_replace('/[^0-9+]/', '', $contact);

            if (str_starts_with($contact, '+84')) {
                $contact = '0'.substr($contact, 3);
            } elseif (str_starts_with($contact, '84')) {
                $contact = '0'.substr($contact, 2);
            }
        }

        $this->merge([
            'tracking_code' => mb_strtoupper(trim((string) $this->input('tracking_code'))),
            'contact' => $contact,
        ]);
    }

    public function rules(): array
    {
        return [
            'tracking_code' => ['required', 'string', 'max:32'],
            'contact' => ['required', 'string', 'max:255'],
        ];
    }

    public function attributes(): array
    {
        return [
            'tracking_code' => 'Mã tra cứu',
            'contact' => 'Số điện thoại hoặc email',
        ];
    }
}
