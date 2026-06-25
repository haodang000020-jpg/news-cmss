<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AssistantQuery extends Model
{
    protected $fillable = [
        'public_id',
        'question',
        'normalized_question',
        'matched_procedure_id',
        'result_count',
        'ip_hash',
        'user_agent',
        'is_resolved',
        'is_helpful',
        'feedback_at',
    ];

    protected function casts(): array
    {
        return [
            'result_count' => 'integer',
            'is_resolved' => 'boolean',
            'is_helpful' => 'boolean',
            'feedback_at' => 'datetime',
        ];
    }

    public function matchedProcedure(): BelongsTo
    {
        return $this->belongsTo(Procedure::class, 'matched_procedure_id');
    }
}
