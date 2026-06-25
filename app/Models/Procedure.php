<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Procedure extends Model
{
    protected $fillable = [
        'procedure_group_id',
        'name',
        'slug',
        'code',
        'summary',
        'applicants',
        'implementing_agency',
        'receiving_place',
        'implementation_method',
        'processing_time',
        'fee',
        'dossier_quantity',
        'result',
        'legal_basis',
        'service_url',
        'keywords',
        'updated_on',
        'sort_order',
        'is_featured',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'updated_on' => 'date',
            'sort_order' => 'integer',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(ProcedureGroup::class, 'procedure_group_id');
    }

    public function requiredDocuments(): HasMany
    {
        return $this->hasMany(ProcedureRequiredDocument::class)
            ->orderBy('sort_order')
            ->orderBy('id');
    }

    public function steps(): HasMany
    {
        return $this->hasMany(ProcedureStep::class)
            ->orderBy('sort_order')
            ->orderBy('id');
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }
}
