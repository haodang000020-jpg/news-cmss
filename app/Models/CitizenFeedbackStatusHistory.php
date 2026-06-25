<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CitizenFeedbackStatusHistory extends Model
{
    public const UPDATED_AT = null;

    protected $fillable = [
        'citizen_feedback_id',
        'changed_by',
        'from_status',
        'to_status',
        'public_note',
        'internal_note',
        'created_at',
    ];

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
        ];
    }

    public function feedback(): BelongsTo
    {
        return $this->belongsTo(CitizenFeedback::class, 'citizen_feedback_id');
    }

    public function changedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'changed_by');
    }

    public function fromStatusLabel(): ?string
    {
        return $this->from_status
            ? (CitizenFeedback::STATUSES[$this->from_status] ?? $this->from_status)
            : null;
    }

    public function toStatusLabel(): string
    {
        return CitizenFeedback::STATUSES[$this->to_status] ?? $this->to_status;
    }
}
