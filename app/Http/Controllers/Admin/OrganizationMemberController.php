<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OrganizationMemberRequest;
use App\Models\OrganizationMember;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class OrganizationMemberController extends Controller
{
    public function index(Request $request): View
    {
        $members = OrganizationMember::query()
            ->with('parent')
            ->when(
                $request->filled('q'),
                function ($query) use ($request): void {
                    $keyword = trim((string) $request->input('q'));

                    $query->where(function ($subQuery) use ($keyword): void {
                        $subQuery
                            ->where('name', 'like', "%{$keyword}%")
                            ->orWhere('position', 'like', "%{$keyword}%")
                            ->orWhere('department', 'like', "%{$keyword}%")
                            ->orWhere('responsibility', 'like', "%{$keyword}%");
                    });
                }
            )
            ->when(
                $request->filled('position_level'),
                fn ($query) => $query->where(
                    'position_level',
                    $request->integer('position_level')
                )
            )
            ->when(
                $request->input('status') === 'active',
                fn ($query) => $query->where('is_active', true)
            )
            ->when(
                $request->input('status') === 'inactive',
                fn ($query) => $query->where('is_active', false)
            )
            ->ordered()
            ->paginate(15)
            ->withQueryString();

        return view(
            'admin.organization-members.index',
            compact('members')
        );
    }

    public function create(): View
    {
        $organizationMember = new OrganizationMember([
            'position_level' => 3,
            'sort_order' => 0,
            'is_active' => true,
        ]);

        $parentOptions = $this->parentOptions();

        return view(
            'admin.organization-members.create',
            compact('organizationMember', 'parentOptions')
        );
    }

    public function store(
        OrganizationMemberRequest $request
    ): RedirectResponse {
        $data = $request->validated();

        if ($request->hasFile('photo')) {
            $data['photo_path'] = $request
                ->file('photo')
                ->store('organization-members', 'public');
        }

        unset($data['photo']);

        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['is_active'] = $request->boolean('is_active');

        OrganizationMember::create($data);

        return redirect()
            ->route('admin.organization-members.index')
            ->with('success', 'Thêm cán bộ vào cơ cấu tổ chức thành công.');
    }

    public function edit(
        OrganizationMember $organizationMember
    ): View {
        $parentOptions = $this->parentOptions(
            $organizationMember->id
        );

        return view(
            'admin.organization-members.edit',
            compact('organizationMember', 'parentOptions')
        );
    }

    public function update(
        OrganizationMemberRequest $request,
        OrganizationMember $organizationMember
    ): RedirectResponse {
        $data = $request->validated();

        $parentId = isset($data['parent_id'])
            ? (int) $data['parent_id']
            : null;

        if ($this->createsHierarchyCycle(
            $organizationMember,
            $parentId
        )) {
            return back()
                ->withInput()
                ->withErrors([
                    'parent_id' =>
                        'Không thể chọn chính cán bộ này hoặc cấp dưới làm người quản lý.',
                ]);
        }

        if ($request->hasFile('photo')) {
            if ($organizationMember->photo_path) {
                Storage::disk('public')->delete(
                    $organizationMember->photo_path
                );
            }

            $data['photo_path'] = $request
                ->file('photo')
                ->store('organization-members', 'public');
        }

        unset($data['photo']);

        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['is_active'] = $request->boolean('is_active');

        $organizationMember->update($data);

        return redirect()
            ->route('admin.organization-members.index')
            ->with('success', 'Cập nhật cơ cấu tổ chức thành công.');
    }

    public function destroy(
        OrganizationMember $organizationMember
    ): RedirectResponse {
        $organizationMember->children()->update([
            'parent_id' => null,
        ]);

        if ($organizationMember->photo_path) {
            Storage::disk('public')->delete(
                $organizationMember->photo_path
            );
        }

        $organizationMember->delete();

        return redirect()
            ->route('admin.organization-members.index')
            ->with('success', 'Xóa cán bộ khỏi cơ cấu tổ chức thành công.');
    }

    private function parentOptions(
        ?int $excludeId = null
    ) {
        return OrganizationMember::query()
            ->when(
                $excludeId,
                fn ($query) => $query->where(
                    'id',
                    '!=',
                    $excludeId
                )
            )
            ->ordered()
            ->get();
    }

    private function createsHierarchyCycle(
        OrganizationMember $member,
        ?int $parentId
    ): bool {
        if (! $parentId) {
            return false;
        }

        $checkedIds = [];

        while ($parentId) {
            if ($parentId === $member->id) {
                return true;
            }

            if (in_array($parentId, $checkedIds, true)) {
                return true;
            }

            $checkedIds[] = $parentId;

            $parentId = OrganizationMember::query()
                ->whereKey($parentId)
                ->value('parent_id');

            $parentId = $parentId ? (int) $parentId : null;
        }

        return false;
    }
}
