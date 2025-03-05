<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class WorkOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'assets_id',
        'user_id',
        'wo_name',
        'instructions',
        'tags',
        'priority',
        'date',
        'time',
        'type',
        'sand_to',
        'location_id',
        'created_by',
        'company_id',
        'status',
        'work_status',
    ];

    public static function priority()
    {

        $priority = [
            [
                'priority' => 'High Priority',
                'color' => 'event-danger',
            ],
            [
                'priority' => 'Medium Priority',
                'color' => 'event-warning',
            ],
            [
                'priority' => 'Low Priority',
                'color' => 'event-success',
            ],
        ];
        return $priority;
    }

    public static function wosstatus()
    {

        $wosstatus = [
            [
                'work_status' => 'Open'
            ],
            [
                'work_status' => 'In Progress'
            ],
            [
                'work_status' => 'Planning'
            ],
            [
                'work_status' => 'Scheduling'
            ],
            [
                'work_status' => 'Suspended'
            ],
        ];
        return $wosstatus;
    }
    public static function assignTo($id){
        $user=User::where('id',$id)->select('id','name')->first();
        if(!(empty($user)))
        {
            return $user->name;
        }

    }
}
