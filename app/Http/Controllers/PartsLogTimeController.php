<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\PartsLogTime;
use App\Models\User;

use Auth;

class PartsLogTimeController extends Controller
{

    public function index()
    {
        
    }


    public function create(Request $request){

        $parts_id = $request->parts_id; 
        return view('parts.partslogtime_create', compact('parts_id'));
    }


    public function store(Request $request){

        if(Auth::user()->can('create parts'))
        {

            $objUser            = Auth::user();
            $Company_ID = $objUser->Company_ID();
            $currentlocation = User::userCurrentLocation();
            if($currentlocation == 0){
                return redirect()->back()->with('error', __('Current location is not available.'));
            }
            $valid = [
                'date' => 'required',
                      ];

            $validator = Validator::make($request->all(), $valid);
            if($validator->fails())
            {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }

            $partslogtime = PartsLogTime::create([
                'parts_id' => $request->parts_id,
                'hours' => $request->hours,
                'minute' => $request->minute,
                'date' => $request->date,
                'description' => $request->description,
                'location_id' => $currentlocation,
                'created_by' => $objUser->id,
                'company_id' => $objUser->Company_ID(),
            ]);

            if($partslogtime){
                return redirect()->back()->with(['success'=> __('Pms created successfully.'),'tab-status'=> 'log_time']);
            }else{
                return redirect()->back()->with(['error'=> __('Something went wrong.'),'tab-status'=> 'log_time']);
            }
            
        }
        
        else{
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function show(PartsLogTime $partslogtime){
        
    }


    public function edit($id){

        $partslogtime = PartsLogTime::find($id);
        return view('parts.partslogtime_edit', compact('partslogtime'));
    }


    public function update(Request $request, $id){

        $objUser            = Auth::user();
        $Company_ID = $objUser->Company_ID();
        $currentlocation = User::userCurrentLocation();
        if($currentlocation == 0){
            return redirect()->back()->with('error', __('Current location is not available.'));
        }

        $partslogtime['parts_id']     = $request->parts_id;
        $partslogtime['hours']      = $request->hours;
        $partslogtime['minute']     = $request->minute;
        $partslogtime['date']       = $request->date;
        $partslogtime['description']       = $request->description;

        $partslogtime = PartsLogTime::where('id',$id)->update($partslogtime);

        return redirect()->back()->with(['success'=> __('Parts Log Time update successfully.'),'tab-status'=> 'log_time']);
    }


    public function destroy($id){


        $partslogtime = PartsLogTime::find($id);

        if($partslogtime)
        {
            if(\Auth::user()->type == 'super admin')
            {
                $partslogtime->delete();
            }
            else
            {
                $partslogtime->delete();
            }
            return redirect()->back()->with(['success' => __('Parts Log Time successfully deleted .'),'tab-status'=> 'log_time']);
        }
        else
        {
            return redirect()->back()->with(['error' => __('Something is wrong.'),'tab-status' => 'log_time']);
        }
    }

}
