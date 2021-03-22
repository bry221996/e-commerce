<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::creating(function ($category) {
            $category->id = Str::uuid()->toString();
        });
    }

    public function getKeyType()
    {
        return 'string';
    }

    public function getIncrementing()
    {
        return false;
    }

    public function getStatusAttribute()
    {
        return $this->is_active ? 'Active' : 'Not Active';
    }

    public function scopeParent($query)
    {
        return $query->whereNull('parent_id');
    }
}
