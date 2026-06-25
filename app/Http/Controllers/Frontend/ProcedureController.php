<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Procedure;
use App\Models\ProcedureGroup;
use App\Models\ProcedureRequiredDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ProcedureController extends Controller
{
    public function index(Request $request): View
    {
        $keyword = trim((string) $request->query('q', ''));
        $groupId = $request->query('procedure_group_id');

        $procedures = Procedure::query()
            ->with('group')
            ->withCount('requiredDocuments')
            ->active()
            ->whereHas('group', fn ($query) => $query->where('is_active', true))
            ->when($keyword !== '', function ($query) use ($keyword): void {
                $query->where(function ($query) use ($keyword): void {
                    $query->where('name', 'like', "%{$keyword}%")
                        ->orWhere('code', 'like', "%{$keyword}%")
                        ->orWhere('summary', 'like', "%{$keyword}%")
                        ->orWhere('keywords', 'like', "%{$keyword}%")
                        ->orWhere('applicants', 'like', "%{$keyword}%")
                        ->orWhere('implementing_agency', 'like', "%{$keyword}%");
                });
            })
            ->when($groupId, function ($query) use ($groupId): void {
                $query->where('procedure_group_id', $groupId);
            })
            ->orderByDesc('is_featured')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate(12)
            ->withQueryString();

        $procedureGroups = ProcedureGroup::query()
            ->active()
            ->withCount([
                'procedures' => fn ($query) => $query->active(),
            ])
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $featuredProcedures = Procedure::query()
            ->with('group')
            ->active()
            ->where('is_featured', true)
            ->whereHas('group', fn ($query) => $query->where('is_active', true))
            ->orderBy('sort_order')
            ->limit(6)
            ->get();

        return view('frontend.procedures.index', [
            'procedures' => $procedures,
            'procedureGroups' => $procedureGroups,
            'featuredProcedures' => $featuredProcedures,
            'keyword' => $keyword,
            'selectedProcedureGroupId' => $groupId,
            'metaTitle' => 'Tra cứu thủ tục hành chính',
            'metaDescription' => 'Tra cứu thành phần hồ sơ, thời hạn, lệ phí và trình tự thực hiện thủ tục hành chính.',
        ]);
    }

    public function show(string $slug): View
    {
        $procedure = Procedure::query()
            ->with(['group', 'requiredDocuments', 'steps'])
            ->active()
            ->whereHas('group', fn ($query) => $query->where('is_active', true))
            ->where('slug', $slug)
            ->firstOrFail();

        $relatedProcedures = Procedure::query()
            ->active()
            ->where('procedure_group_id', $procedure->procedure_group_id)
            ->whereKeyNot($procedure->getKey())
            ->orderByDesc('is_featured')
            ->orderBy('sort_order')
            ->limit(5)
            ->get();

        return view('frontend.procedures.show', [
            'procedure' => $procedure,
            'relatedProcedures' => $relatedProcedures,
            'metaTitle' => $procedure->name,
            'metaDescription' => $procedure->summary ?: 'Thông tin chi tiết thủ tục hành chính.',
        ]);
    }

    public function downloadForm(
        ProcedureRequiredDocument $requiredDocument
    ): StreamedResponse {
        $requiredDocument->load('procedure.group');

        if (
            ! $requiredDocument->procedure?->is_active
            || ! $requiredDocument->procedure?->group?->is_active
            || ! $requiredDocument->form_path
            || ! Storage::disk('public')->exists($requiredDocument->form_path)
        ) {
            abort(404);
        }

        $fileName = $requiredDocument->form_name
            ?: basename($requiredDocument->form_path);

        return Storage::disk('public')->download(
            $requiredDocument->form_path,
            $fileName
        );
    }
}
