<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\AbstractFormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProcedureRequest extends AbstractFormRequest
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
            'is_featured' => $this->boolean('is_featured'),
            'is_active' => $this->boolean('is_active'),
        ]);
    }

    public function rules(): array
    {
        $procedureId = $this->route('procedure')?->id;

        return [
            'procedure_group_id' => [
                'required',
                'integer',
                Rule::exists('procedure_groups', 'id'),
            ],
            'name' => ['required', 'string', 'max:255'],
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('procedures', 'slug')->ignore($procedureId),
            ],
            'code' => ['nullable', 'string', 'max:100'],
            'summary' => ['nullable', 'string'],
            'applicants' => ['nullable', 'string', 'max:255'],
            'implementing_agency' => ['nullable', 'string', 'max:255'],
            'receiving_place' => ['nullable', 'string'],
            'implementation_method' => ['nullable', 'string'],
            'processing_time' => ['nullable', 'string', 'max:255'],
            'fee' => ['nullable', 'string', 'max:255'],
            'dossier_quantity' => ['nullable', 'string', 'max:100'],
            'result' => ['nullable', 'string'],
            'legal_basis' => ['nullable', 'string'],
            'service_url' => ['nullable', 'url', 'max:2048'],
            'keywords' => ['nullable', 'string'],
            'updated_on' => ['nullable', 'date'],
            'sort_order' => ['required', 'integer', 'min:0'],
            'is_featured' => ['required', 'boolean'],
            'is_active' => ['required', 'boolean'],

            'required_documents' => ['nullable', 'array'],
            'required_documents.*.id' => [
                'nullable',
                'integer',
                Rule::exists('procedure_required_documents', 'id'),
            ],
            'required_documents.*.name' => ['required', 'string', 'max:255'],
            'required_documents.*.original_count' => ['nullable', 'integer', 'min:0', 'max:99'],
            'required_documents.*.copy_count' => ['nullable', 'integer', 'min:0', 'max:99'],
            'required_documents.*.note' => ['nullable', 'string'],
            'required_documents.*.is_required' => ['nullable', 'boolean'],
            'required_documents.*.sort_order' => ['nullable', 'integer', 'min:0'],
            'required_documents.*.remove_form' => ['nullable', 'boolean'],
            'required_documents.*.form_file' => [
                'nullable',
                'file',
                'mimes:pdf,doc,docx,xls,xlsx',
                'max:10240',
            ],

            'steps' => ['nullable', 'array'],
            'steps.*.id' => [
                'nullable',
                'integer',
                Rule::exists('procedure_steps', 'id'),
            ],
            'steps.*.title' => ['required', 'string', 'max:255'],
            'steps.*.description' => ['nullable', 'string'],
            'steps.*.sort_order' => ['nullable', 'integer', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'required_documents.*.name.required' => 'Vui lòng nhập tên giấy tờ trong thành phần hồ sơ.',
            'required_documents.*.form_file.mimes' => 'Biểu mẫu chỉ chấp nhận PDF, Word hoặc Excel.',
            'steps.*.title.required' => 'Vui lòng nhập tên bước thực hiện.',
        ];
    }
}
