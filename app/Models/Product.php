<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Spatie\Image\Exceptions\InvalidManipulation;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    /**
     * @var string
     */
    protected $table = 'products';

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'featured' => 'boolean',
        'is_visible' => 'boolean',
        'backorder' => 'boolean',
        'requires_shipping' => 'boolean',
        'published_at' => 'date',
    ];

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_product', 'product_id', 'category_id')->withTimestamps();
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('products_images');
    }

    /**
     * @throws InvalidManipulation
     */
    public function registerAllMediaConversions(): void
    {
        $this->addMediaConversion('small')
            ->width(80)
            ->height(120)
            ->withResponsiveImages()
            ->sharpen(10);

        $this->addMediaConversion('thumb')
            ->width(278)
            ->height(384)
            ->withResponsiveImages()
            ->sharpen(10);

        $this->addMediaConversion('large')
            ->width(592)
            ->height(592)
            ->withResponsiveImages()
            ->sharpen(10);
    }

    public function getImagesAttribute(): MediaCollection
    {
        return $this->getMedia('products_images');
    }

    public function getImageAttribute(): ?Media
    {
        return $this->getFirstMedia('products_images');
    }
}
