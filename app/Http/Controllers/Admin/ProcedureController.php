<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProcedureRequest;
use App\Models\Procedure;
use App\Models\ProcedureGroup;
use App\Models\ProcedureRequiredDocument;
use App\Models\ProcedureStep;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ProcedureController extends Controller
{
    public function index(Request $request): View
    {
        $procedures = Procedure::query()
            ->with('group')
            ->withCount(['requiredDocuments', 'steps'])
            ->when($request->filled('search'), function ($query) use ($request): void {
                $keyword = trim((string) $request->input('search'));

                $query->where(function ($query) use ($keyword): void {
                    $query->where('name', 'like', "%{$keyword}%")
                        ->orWhere('code', 'like', "%{$keyword}%")
                        ->orWhere('implementing_agency', 'like', "%{$keyword}%");
                });
            })
            ->when($request->filled('procedure_group_id'), function ($query) use ($request): void {
                $query->where('procedure_group_id', $request->integer('procedure_group_id'));
            })
            ->when($request->filled('is_active'), function ($query) use ($request): void {
                $query->where('is_active', $request->boolean('is_active'));
            })
            ->orderByDesc('is_featured')
            ->orderBy('sort_order')
            ->orderByDesc('updated_at')
            ->paginate(12)
            ->withQueryString();

        return view('admin.procedures.index', [
            'procedures' => $procedures,
            'procedureGroups' => $this->procedureGroups(),
            'filters' => $request->only([
                'search',
                'procedure_group_id',
                'is_active',
            ]),
        ]);
    }

    public function create(): View
    {
        return view('admin.procedures.create', [
            'procedure' => new Procedure([
                'dossier_quantity' => '01 bộ',
                'sort_order' => 0,
                'is_featured' => false,
                'is_active' => true,
                'updated_on' => now(),
            ]),
            'procedureGroups' => $this->procedureGroups(),
            'requiredDocumentRows' => old('required_documents', []),
            'stepRows' => old('steps', []),
        ]);
    }

    public function store(ProcedureRequest $request): RedirectResponse
    {
        $procedure = DB::transaction(function () use ($request): Procedure {
            $procedure = Procedure::create($this->procedureData($request));

            $this->syncRequiredDocuments($request, $procedure);
            $this->syncSteps($request, $procedure);

            return $procedure;
        });

        return redirect()
            ->route('admin.procedures.edit', $procedure)
            ->with('status', 'Đã thêm thủ tục hành chính.');
    }

    public function edit(Procedure $procedure): View
    {
        $procedure->load(['requiredDocuments', 'steps']);

        return view('admin.procedures.edit', [
            'procedure' => $procedure,
            'procedureGroups' => $this->procedureGroups(),
            'requiredDocumentRows' => old(
                'required_documents',
                $procedure->requiredDocuments->map(fn (ProcedureRequiredDocument $item): array => [
                    'id' => $item->id,
                    'name' => $item->name,
                    'original_count' => $item->original_count,
                    'copy_count' => $item->copy_count,
                    'note' => $item->note,
                    'is_required' => $item->is_required,
                    'sort_order' => $item->sort_order,
                    'form_name' => $item->form_name,
                    'form_path' => $item->form_path,
                ])->all()
            ),
            'stepRows' => old(
                'steps',
                $procedure->steps->map(fn (ProcedureStep $step): array => [
                    'id' => $step->id,
                    'title' => $step->title,
                    'description' => $step->description,
                    'sort_order' => $step->sort_order,
                ])->all()
            ),
        ]);
    }

    public function update(
        ProcedureRequest $request,
        Procedure $procedure
    ): RedirectResponse {
        DB::transaction(function () use ($request, $procedure): void {
            $procedure->update($this->procedureData($request));

            $this->syncRequiredDocuments($request, $procedure);
            $this->syncSteps($request, $procedure);
        });

        return redirect()
            ->route('admin.procedures.edit', $procedure)
            ->with('status', 'Đã cập nhật thủ tục hành chính.');
    }

    public function destroy(Procedure $procedure): RedirectResponse
    {
        $formPaths = $procedure->requiredDocuments()
            ->whereNotNull('form_path')
            ->pluck('form_path')
            ->filter()
            ->all();

        $procedure->delete();

        if ($formPaths !== []) {
            Storage::disk('public')->delete($formPaths);
        }

        return redirect()
            ->route('admin.procedures.index')
            ->with('status', 'Đã xóa thủ tục hành chính.');
    }

    private function procedureData(ProcedureRequest $request): array
    {
        $data = $request->validated();

        unset($data['required_documents'], $data['steps']);

        return $data;
    }

    private function syncRequiredDocuments(
        ProcedureRequest $request,
        Procedure $procedure
    ): void {
        $rows = $request->validated('required_documents', []);
        $keptIds = [];

        foreach ($rows as $index => $row) {
            $document = null;

            if (! empty($row['id'])) {
                $document = $procedure->requiredDocuments()
                    ->whereKey((int) $row['id'])
                    ->first();

                if (! $document) {
                    throw ValidationException::withMessages([
                        "required_documents.{$index}.id" => 'Thành phần hồ sơ không thuộc thủ tục này.',
                    ]);
                }
            }

            $document ??= new ProcedureRequiredDocument([
                'procedure_id' => $procedure->id,
            ]);

            $document->fill([
                'name' => trim((string) $row['name']),
                'original_count' => (int) ($row['original_count'] ?? 0),
                'copy_count' => (int) ($row['copy_count'] ?? 0),
                'note' => $row['note'] ?? null,
                'is_required' => (bool) ($row['is_required'] ?? false),
                'sort_order' => (int) ($row['sort_order'] ?? $index),
            ]);

            if (! empty($row['remove_form']) && $document->form_path) {
                Storage::disk('public')->delete($document->form_path);
                $document->form_path = null;
                $document->form_name = null;
            }

            $uploadedFile = $request->file("required_documents.{$index}.form_file");

            if ($uploadedFile) {
                if ($document->form_path) {
                    Storage::disk('public')->delete($document->form_path);
                }

                $document->form_path = $uploadedFile->store('procedure-forms', 'public');
                $document->form_name = $uploadedFile->getClientOriginalName();
            }

            $document->save();
            $keptIds[] = $document->id;
        }

        $removedDocuments = $procedure->requiredDocuments()
            ->when($keptIds !== [], fn ($query) => $query->whereNotIn('id', $keptIds))
            ->get();

        foreach ($removedDocuments as $removedDocument) {
            if ($removedDocument->form_path) {
                Storage::disk('public')->delete($removedDocument->form_path);
            }

            $removedDocument->delete();
        }
    }

    private function syncSteps(
        ProcedureRequest $request,
        Procedure $procedure
    ): void {
        $rows = $request->validated('steps', []);
        $keptIds = [];

        foreach ($rows as $index => $row) {
            $step = null;

            if (! empty($row['id'])) {
                $step = $procedure->steps()
                    ->whereKey((int) $row['id'])
                    ->first();

                if (! $step) {
                    throw ValidationException::withMessages([
                        "steps.{$index}.id" => 'Bước thực hiện không thuộc thủ tục này.',
                    ]);
                }
            }

            $step ??= new ProcedureStep([
                'procedure_id' => $procedure->id,
            ]);

            $step->fill([
                'title' => trim((string) $row['title']),
                'description' => $row['description'] ?? null,
                'sort_order' => (int) ($row['sort_order'] ?? $index),
            ]);
            $step->save();

            $keptIds[] = $step->id;
        }

        $procedure->steps()
            ->when($keptIds !== [], fn ($query) => $query->whereNotIn('id', $keptIds))
            ->delete();
    }

    private function procedureGroups()
    {
        return ProcedureGroup::query()
            ->orderByDesc('is_active')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();
    }
}
