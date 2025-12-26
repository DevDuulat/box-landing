<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = [
        'name',
    ];

    protected $casts = [
        'name' => 'array',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function getNameAttribute($value)
    {
        $locales = json_decode($value, true) ?: [];
        return $locales[app()->getLocale()] ?? $locales['ru'] ?? $value;
    }
}
