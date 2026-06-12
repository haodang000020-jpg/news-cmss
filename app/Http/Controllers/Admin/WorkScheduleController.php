<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\WorkScheduleRequest;
use App\Models\WorkSchedule;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WorkScheduleController extends Controller
{
    public function index(Request $request): View
    {
        $workSchedules = WorkSchedule::query()
            ->when($request->filled('q'), function ($query) use ($request): void {
                $keyword = $request->string('q');

                $query->where(function ($query) use ($keyword): void {
                    $query->where('title', 'like', '%'.$keyword.'%')
                        ->orWhere('morning_time', 'like', '%'.$keyword.'%')
                        ->orWhere('afternoon_time', 'like', '%'.$keyword.'%')
                        ->orWhere('note', 'like', '%'.$keyword.'%');
                });
            })
            ->ordered()
            ->paginate(10)
            ->withQueryString();

        return view('admin.work-schedules.index', [
            'workSchedules' => $workSchedules,
            'filters' => $request->only(['q']),
        ]);
    }

    public function create(): View
    {
        return view('admin.work-schedules.create', [
            'workSchedule' => new WorkSchedule([
                'is_working_day' => true,
                'sort_order' => 0,
                'is_active' => true,
            ]),
        ]);
    }

    public function store(WorkScheduleRequest $request): RedirectResponse
    {
        WorkSchedule::create($request->validated());

        return redirect()
            ->route('admin.work-schedules.index')
            ->with('status', 'Đã thêm lịch làm việc.');
    }

    public function edit(WorkSchedule $workSchedule): View
    {
        return view('admin.work-schedules.edit', [
            'workSchedule' => $workSchedule,
        ]);
    }

    public function update(WorkScheduleRequest $request, WorkSchedule $workSchedule): RedirectResponse
    {
        $workSchedule->update($request->validated());

        return redirect()
            ->route('admin.work-schedules.index')
            ->with('status', 'Đã cập nhật lịch làm việc.');
    }

    public function destroy(WorkSchedule $workSchedule): RedirectResponse
    {
        $workSchedule->delete();

        return redirect()
            ->route('admin.work-schedules.index')
            ->with('status', 'Đã xóa lịch làm việc.');
    }
}
