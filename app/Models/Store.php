<?php

namespace App\Models;

use App\Traits\UuidAsPrimary;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory, UuidAsPrimary;

    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'identifier';
    }

    public function getBaseUriAttribute()
    {
        return "http://$this->identifier.localhost";
    }
}
