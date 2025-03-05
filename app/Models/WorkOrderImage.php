<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkOrderImage extends Model
{
    use HasFactory;
    protected $fillable = [
        'wo_id',
        'image',
        'location_id',
        'created_by',
        'company_id'
    ];
}
