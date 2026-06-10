<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    public const POSITIONS = [
        'home_slider' => 'Home slider',
        'top_banner' => 'Top banner',
        'sidebar_banner' => 'Sidebar banner',
    ];

    protected $fillable = [
        'title',
        'image',
        'link',
        'position',
        'sort_order',
        'is_active',
        'starts_at',
        'ends_at',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'starts_at' => 'datetime',
            'ends_at' => 'datetime',
            'sort_order' => 'integer',
        ];
    }
}
