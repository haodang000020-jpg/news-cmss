<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LookupLink extends Model
{
    protected $fillable = [
        'title',
        'url',
        'image_path',
        'background_color',
        'sort_order',
        'open_new_tab',
        'is_active',
    ];

    protected $casts = [
        'sort_order' => 'integer',
        'open_new_tab' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }
}