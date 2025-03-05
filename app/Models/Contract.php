<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $fillable = [
        'name',
        'client_name',
        'subject',
        'value',
        'type',
        'start_date',
        'end_date',
        'notes',
        'created_by',
        'status',
    ];

    public function contract_type()
    {
        return $this->hasOne('App\Models\ContractType', 'id', 'type');
    }

    public function client()
    {
        return $this->hasOne('App\Models\User', 'id', 'client_name');
    }

    public static function getContractSummary($contracts)
    {
        $total = 0;

        foreach($contracts as $contract)
        {
            $total += $contract->value;
        }

        return \Auth::user()->priceFormat($total);
    }
}
