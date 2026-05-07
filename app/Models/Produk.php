<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'link',
        'image',
        'meta_title',
        'user_id',
        'created_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    // RELATION
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // SCOPE: published
    public function scopePublished($query)
    {
        return $query->whereNotNull('created_at')
                     ->where('created_at', '<=', now());
    }

    // AUTO SLUG
    protected static function booted()
    {
        static::creating(function ($produk) {
            if (empty($produk->slug)) {
                $produk->slug = Str::slug($produk->title);
            }
        });
    }
}
