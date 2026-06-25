<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CitizenFeedback extends Model
{
    protected $table = 'citizen_feedbacks';
    public const STATUS_NEW = 'new';
    public const STATUS_RECEIVED = 'received';
    public const STATUS_PROCESSING = 'processing';
    public const STATUS_RESOLVED = 'resolved';
    public const STATUS_REJECTED = 'rejected';

    public const STATUSES = [
        self::STATUS_NEW => 'Mới gửi',
        self::STATUS_RECEIVED => 'Đã tiếp nhận',
        self::STATUS_PROCESSING => 'Đang xử lý',
        self::STATUS_RESOLVED => 'Đã giải quyết',
        self::STATUS_REJECTED => 'Không tiếp nhận',
    ];

    protected $fillable = ['public_id', 'tracking_code', 'feedback_category_id', 'full_name', 'phone', 'email', 'address', 'location', 'subject', 'content', 'status', 'admin_response', 'internal_note', 'assigned_to', 'processed_by', 'received_at', 'responded_at', 'closed_at', 'satisfaction_rating', 'satisfaction_comment', 'satisfaction_at', 'ip_hash', 'user_agent'];

    protected function casts(): array
    {
        return [
            'received_at' => 'datetime',
            'responded_at' => 'datetime',
            'closed_at' => 'datetime',
            'satisfaction_rating' => 'integer',
            'satisfaction_at' => 'datetime',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(FeedbackCategory::class, 'feedback_category_id');
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(CitizenFeedbackAttachment::class)->orderBy('id');
    }

    public function histories(): HasMany
    {
        return $this->hasMany(CitizenFeedbackStatusHistory::class)->orderBy('created_at')->orderBy('id');
    }

    public function assignedTo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function processedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'processed_by');
    }

    public function scopeWithStatus(Builder $query, ?string $status): Builder
    {
        return $status ? $query->where('status', $status) : $query;
    }

    public function statusLabel(): string
    {
        return self::STATUSES[$this->status] ?? 'Không xác định';
    }

    public function isClosed(): bool
    {
        return in_array($this->status, [self::STATUS_RESOLVED, self::STATUS_REJECTED], true);
    }

    public function maskedContact(): string
    {
        if ($this->phone) {
            $length = mb_strlen($this->phone);

            if ($length <= 6) {
                return str_repeat('*', max(1, $length - 2)) . mb_substr($this->phone, -2);
            }

            return mb_substr($this->phone, 0, 3) . str_repeat('*', max(3, $length - 6)) . mb_substr($this->phone, -3);
        }

        if ($this->email) {
            [$name, $domain] = array_pad(explode('@', $this->email, 2), 2, '');
            $visible = mb_substr($name, 0, 2);

            return $visible . str_repeat('*', max(2, mb_strlen($name) - 2)) . '@' . $domain;
        }

        return 'Không có thông tin';
    }
}
