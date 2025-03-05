<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetsFieldValues extends Model
{
    use HasFactory;

    protected $fillable = [
        'record_id',
        'field_id',
        'value',
        'created_by',
        'company_id',
        'is_active',
    ];

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'created_by');
    }

    public function getFieldByName($name,$id){
        $value = '';
        $assetsFields = AssetsField::where(['name' => $name, 'module' => 'Assets'])->first();
        if(!is_null($assetsFields)){
            $assetsFieldValues = AssetsFieldValues::where(['field_id' => $assetsFields->id, 'record_id' => $id])->first();
            if(!is_null($assetsFieldValues)){
                $value = $assetsFieldValues->value; 
            }
        }

        return $value;
    }
}
