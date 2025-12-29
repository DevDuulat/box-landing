<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrandingImage extends Model
{
    use HasFactory;

    protected $fillable = ['path', 'is_active'];

    public static function getActiveSlides()
    {
        return self::where('is_active', true)
            ->pluck('path')
            ->map(fn($path) => asset('storage/' . $path))
            ->toArray();
    }
}
