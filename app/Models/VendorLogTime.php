<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorLogTime extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendor_id',
        'user_id',
        'hours',
        'minute',
        'date',
        'description',
        'location_id',
        'created_by',
        'company_id',
    ];
}
