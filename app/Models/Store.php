<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Store extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::creating(function ($store) {
            $store->id = Str::uuid()->toString();
        });
    }

    /**
     * Get the value indicating whether the IDs are incrementing.
     *
     * @return bool
     */
    public function getIncrementing()
    {
        return false;
    }

    public function getRouteKeyName()
    {
        return 'identifier';
    }

    public function getKeyType()
    {
        return 'string';
    }

    public function getBaseUriAttribute()
    {
        return "http://$this->identifier.localhost";
    }
}
