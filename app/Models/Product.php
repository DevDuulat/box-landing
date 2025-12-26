<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'specs',
        'color_type',
        'print_colors_count',
        'dimensions',
        'complies_with_gost_fefco',
        'photo',
        'photo_brown',
        'photo_white',
    ];


    protected $casts = [
        'name' => 'array',
        'color_type' => 'array',
        'dimensions' => 'array',
        'specs' => 'array',
        'complies_with_gost_fefco' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    protected function getTranslatedValue($field, $value)
    {
        $locales = is_array($value) ? $value : json_decode($value, true);
        return $locales[app()->getLocale()] ?? $locales['ru'] ?? $value;
    }

    public function getNameAttribute($value) { return $this->getTranslatedValue('name', $value); }
    public function getColorTypeAttribute($value) { return $this->getTranslatedValue('color_type', $value); }
    public function getDimensionsAttribute($value) { return $this->getTranslatedValue('dimensions', $value); }
}