<?php

namespace App\Models;

use App\Traits\UuidAsPrimary;
use BinaryCats\Sku\Concerns\SkuOptions;
use BinaryCats\Sku\HasSku;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory, HasSku, SoftDeletes, UuidAsPrimary;

    protected $guarded = [];

    /**
     * Get the options for generating the Sku.
     *
     * @return BinaryCats\Sku\SkuOptions
     */
    public function skuOptions(): SkuOptions
    {
        return SkuOptions::make()
            ->from(['name', 'store_id']);
    }

    public function getThumbnailAttribute($value)
    {
        return Storage::disk('s3')->url($value);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_categories', 'product_id', 'category_id');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
