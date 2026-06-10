<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Document extends Model
{
    protected $fillable = [
        'document_category_id',
        'title',
        'slug',
        'code',
        'issuer',
        'issued_at',
        'effective_at',
        'summary',
        'file_path',
        'file_name',
        'file_size',
        'download_count',
        'is_featured',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'issued_at' => 'date',
            'effective_at' => 'date',
            'file_size' => 'integer',
            'download_count' => 'integer',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(DocumentCategory::class, 'document_category_id');
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }
}
