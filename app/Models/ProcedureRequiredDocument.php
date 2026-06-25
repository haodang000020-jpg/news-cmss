<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProcedureRequiredDocument extends Model
{
    protected $fillable = [
        'procedure_id',
        'name',
        'original_count',
        'copy_count',
        'note',
        'form_path',
        'form_name',
        'is_required',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'original_count' => 'integer',
            'copy_count' => 'integer',
            'is_required' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function procedure(): BelongsTo
    {
        return $this->belongsTo(Procedure::class);
    }
}
