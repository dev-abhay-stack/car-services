<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetsField extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'module',
        'created_by',
        'company_id',
        'is_active',
    ];

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'created_by');
    }
}

// CustomField