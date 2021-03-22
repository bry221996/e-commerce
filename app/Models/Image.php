<?php

namespace App\Models;

use App\Traits\UuidAsPrimary;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory, UuidAsPrimary;

    protected $guarded = [];
}
