<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'monthly_price',
        'annual_price',
        'trial_days',
        'duration',
        'max_locations',
        'max_users',
        'max_wo',
        'description',
        'image',
        'status',
    ];

    public  function arrDuration()
    {
        return [
            'Unlimited' => __('Unlimited'),
            'Month' => __('Per Month'),
            'Year' => __('Per Year'),
        ];
    }

    public static $arrDuration = [
        'unlimited' => 'Unlimited',
        'month' => 'Per Month',
        'year' => 'Per Year',
    ];
}
