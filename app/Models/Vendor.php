<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'contact',
        'email',
        'phone',
        'address',
        'assets_id',
        'parts_id',
        'image',
        'location_id',
        'created_by',
        'company_id',
        'is_active',
    ];
}
