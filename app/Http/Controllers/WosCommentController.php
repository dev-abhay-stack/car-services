<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WosComment;
use App\Models\WosCommentImage;
use App\Models\User;
use Auth;
use File;

class WosCommentController extends Controller
{

    public function create(Request $request){

        $wo_id = $request->wo_id;
        return view('workorder.comment_create', compact('wo_id'));
    }

 
    public function store(Request $request){
        
        $objUser            = Auth::user();
        $Company_ID = $objUser->Company_ID();
        $currentlocation = User::userCurrentLocation();

        $Woscomment = WosComment::create([
            'wo_id' => $request->wo_id,
            'description' => $request->description,
            'location_id' => $currentlocation,
            'created_by' => $objUser->id,
            'company_id' => $objUser->Company_ID(),
        ]);


        if($request->hasFile('file')){
            if($Woscomment){
                $files = $request->file;

                foreach($files as $file){
                    $file_data = $file;
                    $file_name = md5(time()) . "_" . $file_data->getClientOriginalName();
                    $file_data->storeAs('wos_comment', $file_name);
    
                    $parts = WosCommentImage::create([
                        'woc_id' => $Woscomment->id,
                        'file' => $file_name,
                        'location_id' => $currentlocation,
                        'created_by' => $objUser->id,
                        'company_id' => $objUser->Company_ID(),
                    ]);
                }

                return redirect()->back()->with(['success'=> __('Comment created successfully.'),'tab-status' => 'comment']);
            }
        }

        return redirect()->back()->with(['success'=> __('Comment created successfully.'),'tab-status' => 'comment']);
    }

    public function destroy($id){
   
        $woscomment = WosComment::find($id);
    
        if($woscomment)
        {
            if(\Auth::user()->user_type == 'super admin')
            {
                $woscomment->delete();
            }
            else
            {
               $workorder_comment_image=WosCommentImage::where('woc_id',$id)->get();
               foreach($workorder_comment_image as $comment_workorder)
               {
                   if($comment_workorder->file)
                   {
                       $d=\File::delete(storage_path('wos_comment/'.$comment_workorder->file));
                       $comment_workorder->delete();
                   }    
               }
                $woscomment->delete();
                return redirect()->back()->with(['success'=> __('Comment Deleted successfully.'),'tab-status' => 'comment']);
            }
            return redirect()->back()->with(['success'=> __('Comment Deleted successfully.'),'tab-status' => 'comment']);
        }
        else
        {
            return redirect()->back()->with(['error' => __('Something is wrong.'),'tab-status' => 'comment']);
        }
    }

    
}
