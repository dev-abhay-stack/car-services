<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\location;
use App\Models\workrequest;
use App\Models\WorkOrder;
use App\Models\WorkOrderImage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;



class WorkrequestController extends Controller
{

    public function index(){
        
    }


    public function create(){

    }


    public function store(Request $request){

        $location_id = Crypt::decrypt($request->location_id);
       
        if(!location::where('id', $location_id)->exists()){
            return redirect()->back()->with('error', __('Something went to wrong'));
        }
        $location = location::find($location_id);


        $workorder = WorkOrder::create([
            'assets_id' => $request->assets_id,
            'wo_name' => $request->wo_name,
            'instructions' => $request->instructions,
            'user_name' => $request->user_name,
            'user_email' => $request->user_email,
            'priority' => 'Low',
            'location_id' => $location_id,
            'company_id' => $location->company_id,
        ]);
     
        if($request->hasFile('file')){
            if($workorder){
                $files = $request->file;
                foreach($files as $file){
                    $file_data = $file;
                    $file_name = md5(time()) . "_" . $file_data->getClientOriginalName();
                    $file_data->storeAs('workorder_files', $file_name);
    
                    $parts = WorkOrderImage::create([
                        'wo_id'       => $workorder->id,
                        'image'       => $file_name,
                        'location_id' => $location_id,
                        'company_id'  => $location->company_id,
                    ]);
                }
                return redirect()->back()->with('success', __('Work order created successfully.'));
            }
        }




        if($workorder){
             return redirect()->back()->with('success', __('Work order created successfully.'));
         }else{
             return redirect()->back()->with('error', __('Something went wrong.'));
         }


    }


    public function show($id){
        
    }


    public function edit($id){
        
    }

 
    public function update(Request $request , $id){
        
    }


    public function destroy($id){
        
    }
}
