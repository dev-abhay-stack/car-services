<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\PmsLogTime;

use Auth;

class PmsLogTimeController extends Controller
{

    public function index(){
        
    }


    public function create(Request $request){

        $pms_id = $request->pms_id; 
        return view('pms.pmslogtime_create', compact('pms_id'));
    }

 
    public function store(Request $request){

        if(Auth::user()->can('create parts'))
        {

            $objUser            = Auth::user();
            $Company_ID = $objUser->Company_ID();
            $currentlocation = User::userCurrentLocation();
            if($currentlocation == 0){
                return redirect()->back()->with(['error', __('Current location is not available.'),'tab-status' => 'log_time']);
            }
            $valid = [
                'hours' => 'required',
                'minute' => 'required',
                'date' => 'required',
                      ];

            $validator = Validator::make($request->all(), $valid);
            if($validator->fails())
            {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }

            $pmslogtime = PmsLogTime::create([
                'pms_id' => $request->pms_id,
                'hours' => $request->hours,
                'minute' => $request->minute,
                'date' => $request->date,
                'description' => $request->description,
                'location_id' => $currentlocation,
                'created_by' => $objUser->id,
                'company_id' => $objUser->Company_ID(),
            ]);

            if($pmslogtime){
                return redirect()->back()->with(['success'=> __('Pms created successfully.'),'tab-status' => 'log_time']);
            }else{
                return redirect()->back()->with(['error'=> __('Something went wrong.'),'tab-status' => 'log_time']);
            }
            
        }
        
        else{
            return redirect()->back()->with(['error'=> __('Permission Denied.'),'tab-status' => 'log_time']);
        }
    }


    public function show(Request $request){ 

    }


    public function edit($id){

        $pmslogtime = PmsLogTime::find($id);
        // dd($pmslogtime);
        return view('pms.pmslogtime_edit', compact('pmslogtime'));
    }


    public function update(Request $request, $id){

        // if(Auth::user()->can('create parts'))
        // {

            $objUser            = Auth::user();
            $Company_ID = $objUser->Company_ID();
            $currentlocation = User::userCurrentLocation();
            if($currentlocation == 0){
                return redirect()->back()->with(['error'=> __('Current location is not available.'),'tab-status' => 'log_time']);
            }

            $pmslogtime['pms_id']     = $request->pms_id;
            $pmslogtime['hours']      = $request->hours;
            $pmslogtime['minute']     = $request->minute;
            $pmslogtime['date']       = $request->date;
            $pmslogtime['description']       = $request->description;

            $pmslogtime = PmsLogTime::where('id',$id)->update($pmslogtime);

            return redirect()->back()->with(['success'=> __('Pms update successfully.'),'tab-status' => 'log_time']);
    }


    public function destroy($id){

        $pmslogtime = PmsLogTime::find($id);

        if($pmslogtime)
        {
            if(\Auth::user()->type == 'super admin')
            {
                $pmslogtime->delete();
            }
            else
            {
                $pmslogtime->delete();
            }
            return redirect()->back()->with(['success'=> __('Pms Log Time successfully deleted .'),'tab-status' => 'log_time']);
        }
        else
        {
            return redirect()->back()->with(['error'=> __('Something is wrong.'),'tab-status' => 'log_time']);
        }
    }
}
