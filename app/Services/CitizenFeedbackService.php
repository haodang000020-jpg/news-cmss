<?php

namespace App\Services;

use App\Models\CitizenFeedback;
use App\Models\CitizenFeedbackAttachment;
use App\Models\CitizenFeedbackStatusHistory;
use App\Models\User;
use App\Notifications\CitizenFeedbackSubmittedNotification;
use App\Notifications\CitizenFeedbackUpdatedNotification;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use RuntimeException;
use Throwable;

class CitizenFeedbackService
{
    /**
     * @param  array<int, UploadedFile>  $attachments
     */
    public function create(
        array $data,
        array $attachments,
        Request $request
    ): CitizenFeedback {
        $feedback = DB::transaction(function () use ($data, $attachments, $request): CitizenFeedback {
            $feedback = CitizenFeedback::create([
                'public_id' => (string) Str::uuid(),
                'tracking_code' => $this->generateTrackingCode(),
                'feedback_category_id' => $data['feedback_category_id'],
                'full_name' => $data['full_name'],
                'phone' => $data['phone'],
                'email' => $data['email'] ?? null,
                'address' => $data['address'] ?? null,
                'location' => $data['location'] ?? null,
                'subject' => $data['subject'],
                'content' => $data['content'],
                'status' => CitizenFeedback::STATUS_NEW,
                'ip_hash' => $this->hashIp($request->ip()),
                'user_agent' => Str::limit((string) $request->userAgent(), 500, ''),
            ]);

            foreach ($attachments as $attachment) {
                $this->storeAttachment($feedback, $attachment);
            }

            CitizenFeedbackStatusHistory::create([
                'citizen_feedback_id' => $feedback->id,
                'from_status' => null,
                'to_status' => CitizenFeedback::STATUS_NEW,
                'public_note' => 'Phản ánh đã được gửi thành công và đang chờ tiếp nhận.',
            ]);

            return $feedback->load(['category', 'attachments', 'histories']);
        });

        $this->notifySubmitted($feedback);

        return $feedback;
    }

    public function updateFromAdmin(
        CitizenFeedback $feedback,
        array $data,
        User $actor
    ): CitizenFeedback {
        $oldStatus = $feedback->status;
        $oldResponse = $feedback->admin_response;

        $feedback = DB::transaction(function () use (
            $feedback,
            $data,
            $actor,
            $oldStatus
        ): CitizenFeedback {
            $newStatus = $data['status'];

            $feedback->fill([
                'status' => $newStatus,
                'assigned_to' => $data['assigned_to'] ?? null,
                'admin_response' => $data['admin_response'] ?? null,
                'internal_note' => $data['internal_note'] ?? null,
                'processed_by' => $actor->id,
            ]);

            $responseChanged = $feedback->isDirty('admin_response');

            if (
                $feedback->received_at === null
                && $newStatus !== CitizenFeedback::STATUS_NEW
            ) {
                $feedback->received_at = now();
            }

            if (
                filled($data['admin_response'] ?? null)
                && $responseChanged
            ) {
                $feedback->responded_at = now();
            }

            if (in_array($newStatus, [
                CitizenFeedback::STATUS_RESOLVED,
                CitizenFeedback::STATUS_REJECTED,
            ], true)) {
                $feedback->closed_at ??= now();
            } else {
                $feedback->closed_at = null;
            }

            $feedback->save();

            if (
                $oldStatus !== $newStatus
                || $responseChanged
                || filled($data['status_public_note'] ?? null)
                || filled($data['status_internal_note'] ?? null)
            ) {
                CitizenFeedbackStatusHistory::create([
                    'citizen_feedback_id' => $feedback->id,
                    'changed_by' => $actor->id,
                    'from_status' => $oldStatus,
                    'to_status' => $newStatus,
                    'public_note' => $data['status_public_note']
                        ?? ($responseChanged ? 'Cơ quan đã cập nhật nội dung phản hồi.' : null),
                    'internal_note' => $data['status_internal_note'] ?? null,
                ]);
            }

            return $feedback->fresh([
                'category',
                'attachments',
                'histories.changedBy',
                'assignedTo',
                'processedBy',
            ]);
        });

        if (
            $oldStatus !== $feedback->status
            || $oldResponse !== $feedback->admin_response
        ) {
            $this->notifyUpdated($feedback);
        }

        return $feedback;
    }

    private function storeAttachment(
        CitizenFeedback $feedback,
        UploadedFile $attachment
    ): CitizenFeedbackAttachment {
        $directory = 'citizen-feedbacks/'.$feedback->public_id;
        $path = $attachment->store($directory, 'local');

        if (! $path) {
            throw new RuntimeException('Không thể lưu tệp đính kèm.');
        }

        return CitizenFeedbackAttachment::create([
            'citizen_feedback_id' => $feedback->id,
            'original_name' => Str::limit(basename($attachment->getClientOriginalName()), 240, ''),
            'disk' => 'local',
            'path' => $path,
            'mime_type' => $attachment->getMimeType(),
            'size_bytes' => $attachment->getSize() ?: 0,
        ]);
    }

    private function generateTrackingCode(): string
    {
        for ($attempt = 0; $attempt < 10; $attempt++) {
            $code = 'PA-'.now()->format('ymd').'-'.Str::upper(Str::random(6));

            if (! CitizenFeedback::query()->where('tracking_code', $code)->exists()) {
                return $code;
            }
        }

        throw new RuntimeException('Không thể tạo mã tra cứu. Vui lòng thử lại.');
    }

    private function hashIp(?string $ip): ?string
    {
        if (! $ip) {
            return null;
        }

        return hash_hmac('sha256', $ip, (string) config('app.key'));
    }

    private function notifySubmitted(CitizenFeedback $feedback): void
    {
        if (! $feedback->email) {
            return;
        }

        try {
            Notification::route('mail', $feedback->email)
                ->notify(new CitizenFeedbackSubmittedNotification($feedback));
        } catch (Throwable $exception) {
            report($exception);
        }
    }

    private function notifyUpdated(CitizenFeedback $feedback): void
    {
        if (! $feedback->email) {
            return;
        }

        try {
            Notification::route('mail', $feedback->email)
                ->notify(new CitizenFeedbackUpdatedNotification($feedback));
        } catch (Throwable $exception) {
            report($exception);
        }
    }
}
