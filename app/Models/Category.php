<?php

namespace App\Models;

use App\Traits\UuidAsPrimary;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes, UuidAsPrimary;

    protected $guarded = [];

    public function getStatusAttribute()
    {
        return $this->is_active ? 'Active' : 'Not Active';
    }

    public function scopeParent($query)
    {
        return $query->whereNull('parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
}
