<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CitizenFeedbackUpdateRequest;
use App\Models\CitizenFeedback;
use App\Models\CitizenFeedbackAttachment;
use App\Models\FeedbackCategory;
use App\Models\User;
use App\Services\CitizenFeedbackService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CitizenFeedbackController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->query('search', ''));
        $status = $request->query('status');
        $categoryId = $request->query('feedback_category_id');

        $feedbacks = CitizenFeedback::query()
            ->with(['category', 'assignedTo'])
            ->withCount('attachments')
            ->when($search !== '', function ($query) use ($search): void {
                $query->where(function ($query) use ($search): void {
                    $query->where('tracking_code', 'like', "%{$search}%")
                        ->orWhere('subject', 'like', "%{$search}%")
                        ->orWhere('full_name', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->when($status, fn ($query) => $query->where('status', $status))
            ->when($categoryId, fn ($query) => $query->where('feedback_category_id', $categoryId))
            ->when($request->filled('from_date'), fn ($query) => $query->whereDate('created_at', '>=', $request->query('from_date')))
            ->when($request->filled('to_date'), fn ($query) => $query->whereDate('created_at', '<=', $request->query('to_date')))
            ->orderByRaw("CASE WHEN status = 'new' THEN 0 WHEN status = 'received' THEN 1 WHEN status = 'processing' THEN 2 ELSE 3 END")
            ->orderByDesc('created_at')
            ->paginate(20)
            ->withQueryString();

        return view('admin.citizen-feedbacks.index', [
            'feedbacks' => $feedbacks,
            'categories' => FeedbackCategory::query()->orderBy('sort_order')->orderBy('name')->get(),
            'statuses' => CitizenFeedback::STATUSES,
            'filters' => [
                'search' => $search,
                'status' => $status,
                'feedback_category_id' => $categoryId,
                'from_date' => $request->query('from_date'),
                'to_date' => $request->query('to_date'),
            ],
            'stats' => [
                'total' => CitizenFeedback::count(),
                'new' => CitizenFeedback::where('status', CitizenFeedback::STATUS_NEW)->count(),
                'processing' => CitizenFeedback::whereIn('status', [
                    CitizenFeedback::STATUS_RECEIVED,
                    CitizenFeedback::STATUS_PROCESSING,
                ])->count(),
                'resolved' => CitizenFeedback::where('status', CitizenFeedback::STATUS_RESOLVED)->count(),
            ],
        ]);
    }

    public function show(CitizenFeedback $citizenFeedback): View
    {
        $citizenFeedback->load([
            'category',
            'attachments',
            'histories.changedBy',
            'assignedTo',
            'processedBy',
        ]);

        return view('admin.citizen-feedbacks.show', [
            'feedback' => $citizenFeedback,
            'statuses' => CitizenFeedback::STATUSES,
            'users' => User::query()->orderBy('name')->get(),
        ]);
    }

    public function update(
        CitizenFeedbackUpdateRequest $request,
        CitizenFeedback $citizenFeedback,
        CitizenFeedbackService $service
    ): RedirectResponse {
        $service->updateFromAdmin(
            $citizenFeedback,
            $request->validated(),
            $request->user()
        );

        return redirect()
            ->route('admin.citizen-feedbacks.show', $citizenFeedback)
            ->with('status', 'Đã cập nhật phản ánh.');
    }

    public function downloadAttachment(
        CitizenFeedback $citizenFeedback,
        CitizenFeedbackAttachment $attachment
    ): StreamedResponse {
        abort_unless($attachment->citizen_feedback_id === $citizenFeedback->id, 404);
        abort_unless(Storage::disk($attachment->disk)->exists($attachment->path), 404);

        return Storage::disk($attachment->disk)->download(
            $attachment->path,
            $attachment->original_name
        );
    }
}
