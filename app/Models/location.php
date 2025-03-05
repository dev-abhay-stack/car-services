<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class location extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'slug',
        'created_by',
        'company_id',
        'lang',
        'interval_time',
        'currency',
        'currency_code',
        'company',
        'city',
        'state',
        'zipcode',
        'country',
        'telephone',
        'logo',
        'is_stripe_enabled',
        'stripe_key',
        'stripe_secret',
        'is_paypal_enabled',
        'paypal_mode',
        'paypal_client_id',
        'paypal_secret_key',
        'invoice_template',
        'invoice_color',
        'invoice_footer_title',
        'invoice_footer_notes',
        'is_active'

    ];

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'created_by');
    }

    public static function create($data)
    {
        $obj          = new Utility();
        $table        = with(new location)->getTable();
        $data['slug'] = $obj->createSlug($table, $data['name']);
        $location    = static::query()->create($data);
        return $location;
    }

    public static function locationLogo($id){
        $location = location::where('id',$id)->pluck('logo');
        return $location;
    }

    public function workorder()
    {
        return $this->hasMany('App\Models\WorkOrder', 'location_id', 'id');
    }


    public function assets()
    {
        return $this->hasMany('App\Models\Assets', 'location_id', 'id');
    }

    public function users()
    {
        return $this->hasMany('App\Models\User', 'location_id', 'id');
    }

    public function languages()
    {
        $dir     = base_path() . '/resources/lang/';
        $glob    = glob($dir . "*", GLOB_ONLYDIR);
        $arrLang = array_map(
            function ($value) use ($dir){
                return str_replace($dir, '', $value);
            }, $glob
        );
        $arrLang = array_map(
            function ($value) use ($dir){
                return preg_replace('/[0-9]+/', '', $value);
            }, $arrLang
        );
        $arrLang = array_filter($arrLang);

        return $arrLang;
    }
}
