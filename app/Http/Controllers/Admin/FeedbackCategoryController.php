<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FeedbackCategoryRequest;
use App\Models\FeedbackCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class FeedbackCategoryController extends Controller
{
    public function index(): View
    {
        return view('admin.feedback-categories.index', [
            'categories' => FeedbackCategory::query()
                ->withCount('feedbacks')
                ->orderByDesc('is_active')
                ->orderBy('sort_order')
                ->orderBy('name')
                ->paginate(20),
        ]);
    }

    public function create(): View
    {
        return view('admin.feedback-categories.create', [
            'feedbackCategory' => new FeedbackCategory([
                'sort_order' => 0,
                'is_active' => true,
            ]),
        ]);
    }

    public function store(
        FeedbackCategoryRequest $request
    ): RedirectResponse {
        FeedbackCategory::create($request->validated());

        return redirect()
            ->route('admin.feedback-categories.index')
            ->with('status', 'Đã thêm lĩnh vực phản ánh.');
    }

    public function edit(
        FeedbackCategory $feedbackCategory
    ): View {
        return view('admin.feedback-categories.edit', [
            'feedbackCategory' => $feedbackCategory,
        ]);
    }

    public function update(
        FeedbackCategoryRequest $request,
        FeedbackCategory $feedbackCategory
    ): RedirectResponse {
        $feedbackCategory->update($request->validated());

        return redirect()
            ->route('admin.feedback-categories.index')
            ->with('status', 'Đã cập nhật lĩnh vực phản ánh.');
    }

    public function destroy(
        FeedbackCategory $feedbackCategory
    ): RedirectResponse {
        if ($feedbackCategory->feedbacks()->exists()) {
            return back()->withErrors([
                'category' => 'Không thể xóa lĩnh vực đang có phản ánh. Hãy tắt hiển thị thay vì xóa.',
            ]);
        }

        $feedbackCategory->delete();

        return redirect()
            ->route('admin.feedback-categories.index')
            ->with('status', 'Đã xóa lĩnh vực phản ánh.');
    }
}
