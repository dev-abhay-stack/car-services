<?php

namespace App\Http\Controllers;

use App\Models\VedioModel;
use App\Models\User;
use Spatie\Permission\Models\Role;
use App\Models\Utility;
use Auth;
use Illuminate\Http\Request;

class VideoModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

         if (Auth::user()->can('manage parts')) {
            $objUser            = Auth::user();
            $Company_ID = $objUser->Company_ID();

            $currentlocation = User::userCurrentLocation();
            $parts = VedioModel::get();

            return view('video.index', compact('parts'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (\Auth::user()->can('create parts')) {
            $assets_id = $request->assets_id;

            $pms_id = $request->pms_id;
            $vendor_id = $request->vendor_id;
            $open_task_id = $request->open_task_id;
            $status = ['draft' => 'Draft', 'published' => 'Published', 'archived' => 'Archived'];
            $category = ['tutorial' => 'Tutorial', 'entertainment' => 'Entertainment', 'education' => 'Education', 'music' => 'Music'];

            $objUser            = Auth::user();
            $Company_ID = $objUser->Company_ID();
            $user  = Auth::user();
        $roles = Role::where('created_by', '=', $user->creatorId())->get()->pluck('name', 'id');
            return view('video.create', compact('assets_id', 'pms_id', 'vendor_id', 'open_task_id', 'status', 'category', 'roles'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // Validate Request Data
         $validator = \Validator::make(
                    $request->all(),
                    [
            'title' => 'required|string|max:255',
            'video' => 'required|mimes:mp4,mov,avi|max:50000', // Example file validation
            'duration' => 'required|integer',
            'category' => 'required|in:tutorial,entertainment,education,music',
            'status' => 'required|in:draft,published,archived',
                    ]
                );

                if ($validator->fails()) {
                    $messages = $validator->getMessageBag();

                    return redirect()->route('videos.index')->with('error', $messages->first());
                }
               $video_name = '';
            if ($request->hasFile('video')) {
                $video = $request->file('video');
                $video_name = md5(time()) . "_" . $video->getClientOriginalName();
                $video->storeAs('Video/free', $video_name);
            }
        // $filePath = $request->file('video')->store('videos', 'public'); // Store in storage/app/public/videos

        VedioModel::create([
            'title' => $request->title,
            'file_path' => $video_name,
            'duration' => $request->duration,
            'category' => $request->category,
            'status' => $request->status,
        ]);
         return redirect()->back()->with('success', __('Video uploaded successfully!'));
       

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VedioModel  $vedioModel
     * @return \Illuminate\Http\Response
     */
    public function show(VedioModel $vedioModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VedioModel  $vedioModel
     * @return \Illuminate\Http\Response
     */
    public function edit(VedioModel $vedioModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VedioModel  $vedioModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VedioModel $vedioModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VedioModel  $vedioModel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

         if (\Auth::user()->can('delete parts')) {
            $parts = VedioModel::find($id);
           
            if ($parts) {
                $thumbnail_file = storage_path('Video/free/' . $parts->file_path);
              
                if ($thumbnail_file) {
                    unlink($thumbnail_file);
                }
                $parts->delete();
                return redirect()->route('videos.index')->with('success', __('Video successfully deleted.'));
            } else {
                return redirect()->back()->with('error', __('Something is wrong.'));
            }
        } else {
            return redirect()->error('error', __('Permission Denied'));
        }
    }
}
