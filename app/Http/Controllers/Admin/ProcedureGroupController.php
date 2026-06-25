<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProcedureGroupRequest;
use App\Models\ProcedureGroup;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProcedureGroupController extends Controller
{
    public function index(): View
    {
        $procedureGroups = ProcedureGroup::query()
            ->withCount('procedures')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('admin.procedure-groups.index', [
            'procedureGroups' => $procedureGroups,
        ]);
    }

    public function create(): View
    {
        return view('admin.procedure-groups.create', [
            'procedureGroup' => new ProcedureGroup([
                'sort_order' => 0,
                'is_active' => true,
            ]),
        ]);
    }

    public function store(ProcedureGroupRequest $request): RedirectResponse
    {
        ProcedureGroup::create($request->validated());

        return redirect()
            ->route('admin.procedure-groups.index')
            ->with('status', 'Đã thêm lĩnh vực thủ tục.');
    }

    public function edit(ProcedureGroup $procedureGroup): View
    {
        return view('admin.procedure-groups.edit', [
            'procedureGroup' => $procedureGroup,
        ]);
    }

    public function update(
        ProcedureGroupRequest $request,
        ProcedureGroup $procedureGroup
    ): RedirectResponse {
        $procedureGroup->update($request->validated());

        return redirect()
            ->route('admin.procedure-groups.index')
            ->with('status', 'Đã cập nhật lĩnh vực thủ tục.');
    }

    public function destroy(ProcedureGroup $procedureGroup): RedirectResponse
    {
        if ($procedureGroup->procedures()->exists()) {
            return redirect()
                ->route('admin.procedure-groups.index')
                ->with('error', 'Không thể xóa lĩnh vực đang có thủ tục.');
        }

        $procedureGroup->delete();

        return redirect()
            ->route('admin.procedure-groups.index')
            ->with('status', 'Đã xóa lĩnh vực thủ tục.');
    }
}
