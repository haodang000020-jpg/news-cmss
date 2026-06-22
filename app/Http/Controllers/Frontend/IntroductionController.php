<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\OrganizationMember;
use Illuminate\View\View;

class IntroductionController extends Controller
{
    public function index(): View
    {
        $members = OrganizationMember::query()
            ->active()
            ->with('parent')
            ->ordered()
            ->get();

        $heads = $members
            ->where('position_level', 1)
            ->values();

        $deputies = $members
            ->where('position_level', 2)
            ->values();

        $staff = $members
            ->where('position_level', 3)
            ->values();

        /*
         * Gom công chức theo người quản lý trực tiếp.
         * Ví dụ:
         * parent_id = ID Phó phòng
         * => công chức sẽ nằm dưới Phó phòng đó.
         */
        $staffByParent = $staff->groupBy('parent_id');

        /*
         * Những công chức:
         * - chưa chọn quản lý;
         * - hoặc được gán trực tiếp cho Trưởng phòng;
         * sẽ được hiển thị tại nhóm Công chức chuyên môn chung.
         */
        $deputyIds = $deputies->pluck('id');

        $unassignedStaff = $staff
            ->reject(function (OrganizationMember $member) use ($deputyIds): bool {
                return $member->parent_id
                    && $deputyIds->contains((int) $member->parent_id);
            })
            ->values();

        $metaTitle = 'Giới thiệu - Cơ cấu tổ chức Phòng VH-XH xã Vĩnh Bình';

        $metaDescription = 'Thông tin lãnh đạo, công chức, chức vụ, lĩnh vực phụ trách và cơ cấu tổ chức Phòng Văn hóa - Xã hội xã Vĩnh Bình.';

        return view('frontend.introduction', compact(
            'heads',
            'deputies',
            'staff',
            'staffByParent',
            'unassignedStaff',
            'metaTitle',
            'metaDescription'
        ));
    }
}
