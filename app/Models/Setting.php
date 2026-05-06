<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_name',
        'logo',
        'address',
        'phone',
        'email',
        'facebook',
        'instagram',
        'youtube',
    ];

    // Helper ambil setting utama
    public static function main()
    {
        return self::first();
    }
}
