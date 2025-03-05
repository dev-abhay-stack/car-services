<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pos extends Model
{
    use HasFactory;

    protected $fillable = [
        'pos_id',
        'parts_id',
        'vendor_id',
        'user_id',
        'pos_date',
        'delivery_date',
        'budgets_id',
        'location_id',
        'created_by',
        'company_id',
        'is_active',
    ];


    public function items()
    {
        return $this->hasMany('App\Models\PosPart', 'pos_id', 'id');
    }

}
