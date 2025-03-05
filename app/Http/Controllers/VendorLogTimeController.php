<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\VendorLogTime;

use Auth;

class VendorLogTimeController extends Controller
{

    public function index(){
        
    }


    public function create(Request $request){

        $vendor_id = $request->vendor_id; 
        return view('vendors.vendorlogtime_create', compact('vendor_id'));
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

            $vendorlogtime = VendorLogTime::create([
                'vendor_id' => $request->vendor_id,
                'hours' => $request->hours,
                'minute' => $request->minute,
                'date' => $request->date,
                'description' => $request->description,
                'location_id' => $currentlocation,
                'created_by' => $objUser->id,
                'company_id' => $objUser->Company_ID(),
            ]);

            if($vendorlogtime){
                return redirect()->back()->with('success', __('Vendor created successfully.'));
            }else{
                return redirect()->back()->with('error', __('Something went wrong.'));
            }
            
        }
        
        else{
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function show(Request $request){
        
    }


    public function edit($id){

        $vendorlogtime = VendorLogTime::find($id);

        return view('vendors.vendorlogtime_edit', compact('vendorlogtime'));
    }


    public function update(Request $request, $id){


            $objUser            = Auth::user();
            $Company_ID = $objUser->Company_ID();
            $currentlocation = User::userCurrentLocation();
            if($currentlocation == 0){
                return redirect()->back()->with('error', __('Current location is not available.'));
            }

            $vendorlogtime['vendor_id']     = $request->vendor_id;
            $vendorlogtime['hours']      = $request->hours;
            $vendorlogtime['minute']     = $request->minute;
            $vendorlogtime['date']       = $request->date;
            $vendorlogtime['description']       = $request->description;

            $vendorlogtime = VendorLogTime::where('id',$id)->update($vendorlogtime);

            return redirect()->back()->with('success', __('Vendor update successfully.'));
          
            
    }


    public function destroy($id){
        $vendorlogtime = VendorLogTime::find($id);
        
        if($vendorlogtime)
        {
            if(\Auth::user()->type == 'super admin')
            {
                $vendorlogtime->delete();
            }
            else
            {
                $vendorlogtime->delete();
            }
            return redirect()->back()->with('success', __('Vendor Log Time successfully deleted .'));
        }
        else
        {
            return redirect()->back()->with('error', __('Something is wrong.'));
        }
    }
}
