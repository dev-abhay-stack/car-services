<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosPart extends Model
{
    use HasFactory;
    protected $fillable = [
        'pos_id',
        'parts_id',
        'quantity',
        'tax',
        'discount',
        'price',
        'description',
        'location_id',
        'created_by',
        'company_id',
        'is_active',
    ];
}
