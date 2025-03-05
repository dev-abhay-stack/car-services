<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WosComment extends Model
{
    use HasFactory;
    protected $fillable = [
        'wo_id',
        'description',
        'location_id',
        'created_by',
        'company_id',
    ];

}
