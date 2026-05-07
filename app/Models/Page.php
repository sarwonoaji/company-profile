<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'title',
        'content',
        'meta_title',
        'is_active',
    ];

    // Scope: hanya halaman aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
