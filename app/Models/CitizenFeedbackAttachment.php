<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CitizenFeedbackAttachment extends Model
{
    protected $fillable = [
        'citizen_feedback_id',
        'original_name',
        'disk',
        'path',
        'mime_type',
        'size_bytes',
    ];

    protected function casts(): array
    {
        return [
            'size_bytes' => 'integer',
        ];
    }

    public function feedback(): BelongsTo
    {
        return $this->belongsTo(CitizenFeedback::class, 'citizen_feedback_id');
    }

    public function humanSize(): string
    {
        if ($this->size_bytes < 1024) {
            return $this->size_bytes.' B';
        }

        if ($this->size_bytes < 1024 * 1024) {
            return number_format($this->size_bytes / 1024, 1).' KB';
        }

        return number_format($this->size_bytes / (1024 * 1024), 1).' MB';
    }
}
