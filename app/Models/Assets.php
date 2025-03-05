<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assets extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'thumbnail',
        'location_id',
        'parts_id',
        'created_by',
        'company_id',
        'is_active',
    ];

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'created_by');
    }
}
