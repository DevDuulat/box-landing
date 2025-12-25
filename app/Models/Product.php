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
        'specs' => 'array',
        'complies_with_gost_fefco' => 'boolean',
        'print_colors_count' => 'integer',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}