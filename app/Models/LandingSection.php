<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LandingSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'title',
        'content',
        'image',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Scope aktif + urut
    public function scopeActive($query)
    {
        return $query->where('is_active', true)
                     ->orderBy('order');
    }
}
