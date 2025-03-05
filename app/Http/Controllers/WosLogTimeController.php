<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Utility;
use App\Models\WosLogTime;

use Auth;


class WosLogTimeController extends Controller
{

    public function index()
    {
    }


    public function create(Request $request)
    {
        if (Auth::user()->can('manage logtime')) {
            $objUser            = Auth::user();
            $currentlocation = User::userCurrentLocation();
            $wo_id = $request->wo_id;
            $users = User::where(['created_by' => $objUser->id, 'location_id' => $currentlocation])->get()->pluck('name', 'id');
            return view('workorder.wologtime_create', compact('wo_id', 'users'));
        } else {
            return redirect()->back()->with('error', 'Permission Denied.');
        }
    }


    public function store(Request $request)
    {
        if (Auth::user()->can('create logtime')) {

            $objUser            = Auth::user();
            $currentlocation = User::userCurrentLocation();
            if ($currentlocation == 0) {
                return redirect()->back()->with('error', __('Current location is not available.'));
            }
            $Company_ID = $objUser->Company_ID();

            $valid = [
                'hours' => 'required',
                'minute' => 'required',
                'date' => 'required',
            ];

            $validator = Validator::make($request->all(), $valid);
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }
            if ($objUser->user_type == "company") {
                $user_id = $request->user_id;
            } else {
                $user_id = $objUser->id;
            }

            $woslogtime = WosLogTime::create([
                'wo_id' => $request->wo_id,
                'user_id' => $user_id,
                'hours' => $request->hours,
                'minute' => $request->minute,
                'date' => $request->date,
                'description' => $request->description,
                'location_id' => $currentlocation,
                'created_by' => $objUser->id,
                'company_id' => $objUser->Company_ID(),
            ]);

            if ($woslogtime) {
                return redirect()->back()->with(['success' => __('Log time created successfully.'), 'tab-status' => 'log_time']);
            } else {
                return redirect()->back()->with(['error' => __('Something went wrong.'), 'tab-status' => 'log_time']);
            }
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function show(Request $request)
    {
    }


    public function edit($id)
    {
       
            $objUser            = Auth::user();
            $currentlocation = User::userCurrentLocation();
            $woslogtime = WosLogTime::find($id);

            $users = User::where(['created_by' => $objUser->id, 'location_id' => $currentlocation])->get()->pluck('name', 'id');
            return view('workorder.wologtime_edit', compact('woslogtime', 'users'));
       
    }


    public function update(Request $request, $id)
    {

      
            $objUser            = Auth::user();
            $Company_ID = $objUser->Company_ID();
            $currentlocation = User::userCurrentLocation();
            if ($currentlocation == 0) {
                return redirect()->back()->with(['error' => __('Current location is not available.'), 'tab-status' => 'log_time']);
            }
            if ($objUser->user_type == "company") {
                $user_id = $request->user_id;
            } else {
                $user_id = $objUser->id;
            }

            $woslogtime['wo_id']     = $request->wo_id;
            $woslogtime['hours']      = $request->hours;
            $woslogtime['minute']     = $request->minute;
            $woslogtime['date']       = $request->date;
            $woslogtime['description']       = $request->description;
            $woslogtime['user_id']     = $user_id;

            $woslogtime = WosLogTime::where('id', $id)->update($woslogtime);


            return redirect()->back()->with(['success' => __('Log Time update successfully.'), 'tab-status' => 'log_time']);
        
    }


    public function destroy($id)
    {
        if (Auth::user()->can('delete logtime')) {
            $woslogtime = WosLogTime::find($id);

            if ($woslogtime) {
                if (\Auth::user()->type == 'super admin') {
                    $woslogtime->delete();
                } else {
                    $woslogtime->delete();
                }
                return redirect()->back()->with('success', __(' Log Time deleted successfully .'));
            } else {
                return redirect()->back()->with('error', __('Something is wrong.'));
            }
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }
}

