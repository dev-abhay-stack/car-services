<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PmsInvoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'pms_id',
        'invoice_cost',
        'description',
        'invoice_file',
        'location_id',
        'created_by',
        'company_id',
    ];
}
