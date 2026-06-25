<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\CitizenFeedbackLookupRequest;
use App\Http\Requests\Frontend\CitizenFeedbackRatingRequest;
use App\Http\Requests\Frontend\CitizenFeedbackStoreRequest;
use App\Models\CitizenFeedback;
use App\Models\CitizenFeedbackAttachment;
use App\Models\FeedbackCategory;
use App\Services\CitizenFeedbackService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CitizenFeedbackController extends Controller
{
    public function create(): View
    {
        return view('frontend.feedbacks.create', [
            'categories' => FeedbackCategory::query()
                ->active()
                ->orderBy('sort_order')
                ->orderBy('name')
                ->get(),
            'metaTitle' => 'Phản ánh - kiến nghị trực tuyến',
            'metaDescription' => 'Gửi phản ánh, kiến nghị và theo dõi trạng thái xử lý trực tuyến.',
        ]);
    }

    public function store(
        CitizenFeedbackStoreRequest $request,
        CitizenFeedbackService $service
    ): RedirectResponse {
        $feedback = $service->create(
            $request->safe()->except([
                'attachments',
                'agree_privacy',
                'website',
            ]),
            $request->file('attachments', []),
            $request
        );

        return redirect()
            ->route('frontend.feedbacks.show', $feedback->public_id)
            ->with('status', 'Phản ánh đã được gửi thành công.')
            ->with('new_tracking_code', $feedback->tracking_code);
    }

    public function lookupForm(): View
    {
        return view('frontend.feedbacks.lookup', [
            'metaTitle' => 'Tra cứu phản ánh - kiến nghị',
            'metaDescription' => 'Tra cứu trạng thái xử lý phản ánh bằng mã hồ sơ và thông tin liên hệ.',
        ]);
    }

    public function lookup(
        CitizenFeedbackLookupRequest $request
    ): RedirectResponse {
        $trackingCode = $request->validated('tracking_code');
        $contact = $request->validated('contact');

        $feedback = CitizenFeedback::query()
            ->where('tracking_code', $trackingCode)
            ->where(function ($query) use ($contact): void {
                $query->where('phone', $contact)
                    ->orWhereRaw('LOWER(email) = ?', [mb_strtolower($contact)]);
            })
            ->first();

        if (! $feedback) {
            return back()
                ->withInput()
                ->withErrors([
                    'tracking_code' => 'Không tìm thấy phản ánh phù hợp với mã tra cứu và thông tin liên hệ.',
                ]);
        }

        return redirect()->route(
            'frontend.feedbacks.show',
            $feedback->public_id
        );
    }

    public function show(string $publicId): View
    {
        $feedback = CitizenFeedback::query()
            ->with([
                'category',
                'attachments',
                'histories' => fn ($query) => $query
                    ->whereNotNull('public_note')
                    ->orWhereColumn('from_status', '!=', 'to_status'),
            ])
            ->where('public_id', $publicId)
            ->firstOrFail();

        return view('frontend.feedbacks.show', [
            'feedback' => $feedback,
            'metaTitle' => 'Theo dõi phản ánh '.$feedback->tracking_code,
            'metaDescription' => 'Theo dõi trạng thái xử lý phản ánh, kiến nghị trực tuyến.',
            'metaRobots' => 'noindex,nofollow',
        ]);
    }

    public function downloadAttachment(
        string $publicId,
        CitizenFeedbackAttachment $attachment
    ): StreamedResponse {
        $feedback = CitizenFeedback::query()
            ->where('public_id', $publicId)
            ->firstOrFail();

        abort_unless($attachment->citizen_feedback_id === $feedback->id, 404);
        abort_unless(Storage::disk($attachment->disk)->exists($attachment->path), 404);

        return Storage::disk($attachment->disk)->download(
            $attachment->path,
            $attachment->original_name
        );
    }

    public function rate(
        CitizenFeedbackRatingRequest $request,
        string $publicId
    ): RedirectResponse {
        $feedback = CitizenFeedback::query()
            ->where('public_id', $publicId)
            ->firstOrFail();

        if ($feedback->status !== CitizenFeedback::STATUS_RESOLVED) {
            return back()->withErrors([
                'rating' => 'Chỉ có thể đánh giá sau khi phản ánh đã được giải quyết.',
            ]);
        }

        if ($feedback->satisfaction_at !== null) {
            return back()->withErrors([
                'rating' => 'Phản ánh này đã được đánh giá trước đó.',
            ]);
        }

        $feedback->update([
            'satisfaction_rating' => $request->integer('rating'),
            'satisfaction_comment' => $request->validated('comment'),
            'satisfaction_at' => now(),
        ]);

        return back()->with('status', 'Cảm ơn bạn đã gửi đánh giá.');
    }
}
