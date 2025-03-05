<?php

namespace App\Http\Controllers;


use App\Models\WorkOrder;
use App\Models\Utility;
use Illuminate\Support\Facades\Auth;

class CalenderController extends Controller
{
    public function index()
    {
        $objUser          = Auth::user();
        $transdate = date('Y-m-d', time());
        $Company_ID = $objUser->Company_ID();
        if($objUser->user_type=="company")
        {
            $events    = WorkOrder::where(['company_id' => $Company_ID, 'location_id' => $objUser->current_location, 'status' => 1])->get();
        }
        else{
            $events    = WorkOrder::where(['company_id' => $Company_ID, 'location_id' => $objUser->location_id, 'status' => 1])->get();

        }
        
        
        $arrEvents = [];
        $events_current_month =  WorkOrder::whereMonth('date', date('m')) ->whereYear('date', date('Y')) ->get(['wo_name','date','priority']);
        $abc = WorkOrder::priority();
        foreach($events as $event)
        {
            $startdate = $event->updated_at->format('Y-m-d');
            $key = array_search($event->priority, array_column($abc, 'priority'));
            $data_bg = $abc[$key];

            $arr['id']    = $event->id;
            $arr['title'] = $event->wo_name;
            $arr['start']   = $event->date;
            $arr['priority']   = $event->priority;
            $arr['className'] = $data_bg['color'];
            $arr['url']  = route('opentask.show',[$event['id']]);
            $arrEvents[] = $arr;
        }

        return view('calendar.index', compact('arrEvents','transdate','events_current_month'));

    }
    
       
    
}
