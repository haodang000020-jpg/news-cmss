<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OrganizationMember extends Model
{
    protected $fillable = [
        'parent_id',
        'name',
        'position',
        'position_level',
        'department',
        'responsibility',
        'phone',
        'email',
        'photo_path',
        'biography',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'position_level' => 'integer',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(
            OrganizationMember::class,
            'parent_id'
        );
    }

    public function children(): HasMany
    {
        return $this->hasMany(
            OrganizationMember::class,
            'parent_id'
        )->orderBy('position_level')
            ->orderBy('sort_order')
            ->orderBy('name');
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query
            ->orderBy('position_level')
            ->orderBy('sort_order')
            ->orderBy('name');
    }

    public function getLevelLabelAttribute(): string
    {
        return match ($this->position_level) {
            1 => 'Trưởng phòng',
            2 => 'Phó phòng',
            3 => 'Công chức',
            default => 'Khác',
        };
    }
}