<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    public function category(): BelongsTo {
        return $this->belongsTo(ProductCategory::class);
    }

    public function orders(): BelongsToMany {
        return $this->belongsTo(Order::class);
    }

    protected $fillable = [
        'name',
        'description',
        'category_id',
        'youtube_video_id',
        'images',
        'attachments',
        'published_at',
        'unpublished_at',
        'is_featured',
        'is_new',
        'is_active',
    ];

    protected $casts = [
        'tags' => 'array',
        'images' => 'array',
        'attachments' => 'array',
        'is_featured' => 'boolean',
        'is_new' => 'boolean',
        'is_active' => 'boolean',
        'published_at' => 'datetime',
        'unpublished_at' => 'datetime',
    ];
}
