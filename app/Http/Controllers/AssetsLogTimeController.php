<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\AssetsLogTime;
use App\Models\User;

use Auth;

class AssetsLogTimeController extends Controller
{
    public function index()
    {
        
    }

    public function create(Request $request)
    {
        $assets_id = $request->assets_id; 
        return view('assets.assetslogtime_create', compact('assets_id'));
    }

    
    public function store(Request $request)
    {
        if(Auth::user()->can('create parts'))
        {

            $objUser            = Auth::user();
            $Company_ID = $objUser->Company_ID();
            $currentlocation = User::userCurrentLocation();
            if($currentlocation == 0){
                return redirect()->back()->with(['error'=> __('Current location is not available.'),'tab-status' => 'log_time']);
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

            $assetslogtime = AssetsLogTime::create([
                'assets_id' => $request->assets_id,
                'hours' => $request->hours,
                'minute' => $request->minute,
                'date' => $request->date,
                'description' => $request->description,
                'location_id' => $currentlocation,
                'created_by' => $objUser->id,
                'company_id' => $objUser->Company_ID(),
            ]);

            if($assetslogtime){
                return redirect()->back()->with(['success'=> __('Assets Log Time created successfully.'),'tab-status' => 'log_time']);
            }else{
                return redirect()->back()->with(['error'=> __('Something went wrong.'),'tab-status' => 'log_time']);
            }
        }
        else{
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }

    
    public function show(AssetsLogTime $assetslogtime)
    {
        
    }

    
    public function edit($id)
    {
        $assetslogtime = AssetsLogTime::find($id);
        return view('assets.assetslogtime_edit', compact('assetslogtime'));
    }

    
    public function update(Request $request, $id)
    {
        $objUser            = Auth::user();
        $Company_ID = $objUser->Company_ID();
        $currentlocation = User::userCurrentLocation();
        if($currentlocation == 0){
            return redirect()->back()->with(['error'=> __('Current location is not available.'),'tab-status' => 'log_time']);
        }

        $assetslogtime['assets_id']     = $request->assets_id;
        $assetslogtime['hours']      = $request->hours;
        $assetslogtime['minute']     = $request->minute;
        $assetslogtime['date']       = $request->date;
        $assetslogtime['description']       = $request->description;

        $assetslogtime = AssetsLogTime::where('id',$id)->update($assetslogtime);

        return redirect()->back()->with(['success'=> __('Assets Log Time update successfully.'),'tab-status' => 'log_time']);
    }

    
    public function destroy($id)
    {
        $assetslogtime = AssetsLogTime::find($id);

        if($assetslogtime)
        {
            if(\Auth::user()->type == 'super admin')
            {
                $assetslogtime->delete();
            }
            else
            {
                $assetslogtime->delete();
            }
            return redirect()->back()->with(['success' => __('Assets Log Time successfully deleted .'),'tab-status' => 'log_time']);
        }
        else
        {
            return redirect()->back()->with(['error' => __('Something is wrong.'),'tab-status' => 'log_time']);
        }
    }
}
