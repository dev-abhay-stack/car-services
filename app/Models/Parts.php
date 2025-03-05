<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parts extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'thumbnail',
        'number',
        'quantity',
        'price',
        'category',
        'vendor_id',
        'assets_id',
        'location_id',
        'created_by',
        'company_id',
        'is_active',
    ];

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'created_by');
    }
}
