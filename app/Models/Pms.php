<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pms extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location_id',
        'description',
        'parts_id',
        'tags',
        'created_by',
        'company_id',
        'is_active',
    ];
    
}
