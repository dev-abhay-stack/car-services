<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WosCommentImage extends Model
{
    use HasFactory;
    protected $fillable = [
        'woc_id',
        'file',
        'location_id',
        'created_by',
        'company_id',
    ];

    public static function getFile($id){
        return WosCommentImage::where('woc_id', $id)->get();
    }
}
