<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WorkOrder;
use App\Models\WorkOrderImage;
use App\Models\Assets;
use App\Models\User;
use App\Models\AssetsFieldValues;
use App\Models\AssetsLogTime;
use App\Models\Parts;
use App\Models\Plan;
use App\Models\Pos;
use App\Models\WosLogTime;
use App\Models\WosInvoice;
use App\Models\WosComment;
use App\Models\WosCommentImage;
use App\Models\Utility;
use App\Imports\WorkorderImport;
use Maatwebsite\Excel\Facades\Excel;
use Auth;
use DB;

class WorkOrderController extends Controller
{
    public function index()
    {
        //if login user get permission of manage wos then only work order page open
        if (\Auth::user()->can('manage wos')) {
            $objUser            = Auth::user();
            $Company_ID = $objUser->Company_ID();
            if ($objUser->user_type == "company") {
                //open work order data form company login
                
                $work_order = WorkOrder::where(['company_id' => $Company_ID, 'location_id' => $objUser->current_location, 'status' => 1])->get();
                return view('workorder.index', compact('work_order'));
            } else {
                // open work order data for employee login
                $work_order = WorkOrder::where('company_id',$Company_ID)->where('location_id',$objUser->location_id)->where('status', 1)->get();
                $assign_work_order = WorkOrder::whereRaw("FIND_IN_SET(" . $objUser->id . ",sand_to)")->where('status', 1)->get();
                return view('workorder.index', compact('work_order', 'assign_work_order'));
            }
        } else {
            return redirect()->back()->with('error', __('Pernission Denied.'));
        }
    }

    public function create(Request $request)
    {
        //if login user get permission of create wos then only create work order page open
        if (\Auth::user()->can('create wos')) {
            $assets_id = $request->assets_id;
            $assets = Assets::where(['company_id' => Auth::user()->Company_ID(), 'location_id' => User::userCurrentLocation(), 'is_active' => 1])->get()->pluck('name', 'id');
            $user = User::where(['company_id' => Auth::user()->Company_ID(), 'location_id' => User::userCurrentLocation(), 'is_deleted' => 0])->get()->pluck('name', 'id');
            return view('workorder.create', compact('assets', 'user', 'assets_id'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function store(Request $request)
    {
        if (\Auth::user()->can('create wos')) {
            $objUser            = Auth::user();
      

            $currentlocation = User::userCurrentLocation();
            $plan             = Plan::find($objUser->plan);
            if ($plan) {
                $totalWS = $objUser->countLocationWo($currentlocation);
                if ($totalWS < $plan->max_wo || $plan->max_wo == -1) {
                    if ($currentlocation == 0) {
                        return redirect()->back()->with('error', __('Current location is not available.'));
                    }

                    $workorder = WorkOrder::create([
                        'assets_id' => $request->assets_id,
                        'wo_name' => $request->wo_name,
                        'instructions' => $request->instructions,
                        'tags' => $request->tags,
                        'priority' => $request->priority,
                        'date' => $request->date,
                        'time' => $request->time,
                        'sand_to' => !empty($request->user) ? implode(',', $request->user) : '',
                        'work_status' => 'Open',
                        'location_id' => $currentlocation,
                        'created_by' => $objUser->id,
                        'company_id' => $objUser->Company_ID(),
                    ]);

                    if ($workorder) {
                        return redirect()->back()->with('success', __('Work order created successfully.'));
                    } else {
                        return redirect()->back()->with('error', __('Something went wrong.'));
                    }
                } else {
                    return redirect()->back()->with('error', __('Your Work order limit is over, Please upgrade plan.'));
                }
            } else {
                return redirect()->back()->with('error', __('Default plan is deleted.'));
            }
        } else {
            return redirect()->back()->with('error', __("Permission denied."));
        }
    }


    public function show($id)
    {
        if (\Auth::user()->can('manage wos')) {
            $Workorder = WorkOrder::where(['id' => $id])->first();

            if (!is_null($Workorder)) {
                $module_assets = 'assets';

                $AssetsField = DB::table('assets_field_values')->leftJoin('assets_fields', 'assets_field_values.field_id', '=', 'assets_fields.id')->where(['record_id' => $id])->get();

                
                $parts = DB::table('work_orders')->leftJoin('parts', function ($join) {
                    $join->whereRaw(DB::raw("find_in_set(parts.id,work_orders.parts_id)"));
                })->where('parts.id', '!=', null)->where('work_orders.id', $Workorder->id)->get();

                

                $Workorder_file = WorkOrderImage::where(['wo_id' => $id])->get();

                $woslogtime = DB::table('wos_log_times')
                    ->join('users', 'wos_log_times.user_id', '=', 'users.id')
                    ->select('wos_log_times.*', 'users.*', 'wos_log_times.id as wos_lt')
                    ->where(['wos_log_times.wo_id' => $id])
                    ->get();


                $wo_pos = DB::table('pos')
                    ->join('users', 'pos.user_id', '=', 'users.id')
                    ->join('vendors', 'pos.vendor_id', '=', 'vendors.id')
                    ->select(DB::raw('pos.*, users.name as user_name, vendors.name as vendor_name'))
                    ->where('pos.wo_id', $id)
                    ->get();


                $wosinvoice =  WosInvoice::where(['wo_id' => $id])->get();

                $woscomment =  WosComment::where(['wo_id' => $id])->get();

                $Assets_data =  Assets::find($Workorder->assets_id);

                $sanddata =  User::whereIn('id', explode(',', $Workorder->sand_to))->get()->pluck('name');
                $Sand_data = [];
                if (count($sanddata) > 0) {
                    foreach ($sanddata as $datasand) {
                        $Sand_data[] = $datasand;
                    }
                }

                $Workorder_tag = explode(',', $Workorder->tags);

                $chartData = $this->getChartData(['duration' => 'year', 'workorder_id' => $id]);

                $hours = DB::table("wos_log_times")->where('wo_id', $id)->sum('hours');
                $minutes = DB::table("wos_log_times")->where('wo_id', $id)->sum('minute');
                // $min_hours = intdiv($minutes, 60).':'. ($minutes % 60);
                $min_hours = number_format($minutes / 60);


                if ($woslogtime) {
                    $total_spend = (int)$hours + (int)$min_hours;
                } else {
                    $total_spend = 0;
                }


                $arrPartsper = [];
                $arrPartsLabel = ['Not Purchased ', 'Purchased '];
                $total_parts = Parts::where('location_id', Auth::user()->location_id)->count();
                $WorkorderParts = Pos::where('location_id', Auth::user()->location_id)->where('wo_id', $id)->count();
                $purchase  = 0;  
                if ($total_parts == 0) {
                    $tp = 0.0;
                } else {
                    $purchase = round($WorkorderParts * 100 / $total_parts, 2);
                }

                $arrPartsper[0] = 100 - $purchase;
                $arrPartsper[1] = $purchase;


                return view('workorder.detail', compact('Workorder', 'wo_pos', 'AssetsField', 'parts', 'Workorder_file', 'woslogtime', 'wosinvoice', 'woscomment', 'Workorder_tag', 'Assets_data', 'Sand_data', 'chartData', 'total_spend', 'arrPartsper', 'arrPartsLabel'));
            } else {
                return redirect()->back()->with('error', __('Permission Denied.'));
            }
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function edit($id)
    {
        if (\Auth::user()->can('edit wos')) {
            $assets = Assets::where(['company_id' => Auth::user()->Company_ID(), 'location_id' => User::userCurrentLocation(), 'is_active' => 1])->get()->pluck('name', 'id');
            $user = User::where(['company_id' => Auth::user()->Company_ID(), 'location_id' => User::userCurrentLocation(), 'is_deleted' => 0])->get()->pluck('name', 'id');
            $workorder = WorkOrder::find($id);
            return view('workorder.edit', compact('workorder', 'assets', 'user'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function update(Request $request, $id)
    {
        $objUser            = Auth::user();
        if (\Auth::user()->can('edit wos')) {
            $currentlocation = User::userCurrentLocation();
            if ($currentlocation == 0) {
                return redirect()->back()->with('error', __('Current location is not available.'));
            }
            $SandTo = WorkOrder::where(['id' => $id])->first();


            $workorder['assets_id']   = $request->assets_id;
            $workorder['wo_name']     = $request->wo_name;
            $workorder['instructions'] = $request->instructions;
            $workorder['tags']        = $request->tags;
            $workorder['priority']    = $request->priority;
            $workorder['date']        = $request->date;
            $workorder['time']        = $request->time;
            $workorder['sand_to']     = !empty($request->user) ? implode(",", $request->user) : '';
            $workorder['location_id'] = $currentlocation;
            $workorder['created_by']  = $objUser->id;
            $workorder['company_id']  = $objUser->Company_ID();

            $workorder = WorkOrder::where('id', $id)->update($workorder);

            if ($workorder) {
                return redirect()->back()->with('success', __('Work order update successfully.'));
            } else {
                return redirect()->back()->with('error', __('Something went wrong.'));
            }
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function completetask()
    {
        $objUser            = Auth::user();
        if ($objUser->user_type == "company") {
            $Company_ID = $objUser->Company_ID();
            $work_order = WorkOrder::where(['company_id' => $Company_ID, 'location_id' => $objUser->current_location, 'status' => 2])->get();
            return view('workorder.complete', compact('work_order'));
        } else {
            $assign_work_order = WorkOrder::whereRaw("FIND_IN_SET(" . $objUser->id . ",sand_to)")->where('status', 2)->get();
            $work_order = WorkOrder::where('created_by', $objUser->id)->where('status', 2)->get();
            return view('workorder.complete', compact('work_order', 'assign_work_order'));
        }
    }


    public function taskcomplete(Request $request)
    {
        $task_id = $request->task_id;
        return view('workorder.taskcomplete', compact('task_id'));
    }


    public function updatetaskcomplete(Request $request)
    {
        // complete task
        $task_id = $request->task_id;

        $woscomment['hours']     = $request->hours;
        $woscomment['minute']    = $request->minute;
        $woscomment['status']    = 2;
        $woscomment['work_status'] = null;
        $woscomments = WorkOrder::where('id', $task_id)->update($woscomment);

        if (!empty($woscomments)) {
            return redirect()->back()->with(['success' => __('Task Complete Successfully.'), 'tab-status' => 'comment']);
        } else {
            return redirect()->back()->with(['error' => __('Something went wrong.'), 'tab-status' => 'comment']);
        }
    }


    public function taskreopen($id)
    {
        //reopen task
        $woscomment['hours']      = null;
        $woscomment['minute']      = null;
        $woscomment['status']    = 1;
        $woscomment['work_status'] = 'Open';
        $woscomments = WorkOrder::where('id', $id)->update($woscomment);

        if (!empty($woscomments)) {
            return redirect()->back()->with(['success' => __('Task Reopen Successfully.'), 'tab-status' => 'comment']);
        } else {
            return redirect()->back()->with(['error' => __('Something went wrong.'), 'tab-status' => 'comment']);
        }
    }


    public function destroy($id)
    {
        if (\Auth::user()->can('delete wos')) {
            $workorder = WorkOrder::find($id);

            if ($workorder) {
                if (\Auth::user()->type == 'super admin') {
                    $workorder->delete();
                } else {
                    $workorder->delete();
                }
                return redirect()->back()->with('success', __('Work Order successfully deleted .'));
            } else {
                return redirect()->back()->with('error', __('Something is wrong.'));
            }
        } else {
            return redirect()->back()->with('error', __("Permission Denied"));
        }
    }


    public function fileUpload($id, Request $request)
    {
        $objUser = Auth::user();
        $Company_ID = $objUser->Company_ID();
        $currentlocation = User::userCurrentLocation();

        $request->validate(['file' => 'required|mimes:png,jpeg,jpg,pdf,doc,txt,application/octet-stream,audio/mpeg,mpga,mp3,wav|max:20480']);
        $file_name = $request->file->getClientOriginalName();
        $file_path = $request->lead_id . "_" . md5(time()) . "_" . $request->file->getClientOriginalName();
        $request->file->storeAs('workorder_files', $file_path);

        $file = WorkOrderImage::create(
            [
                'wo_id'       => $id,
                'image'       => $file_path,
                'location_id' => $currentlocation,
                'created_by'  => $objUser->id,
                'company_id'  => $objUser->Company_ID(),
            ]
        );
        $return               = [];
        $return['is_success'] = true;
        $return['download']   = route(
            'opentask.file.download',
            [$file->id]
        );

        $return['delete']     = route(
            'opentask.file.delete',
            [$file->id]
        );

        return response()->json($return);
    }


    public function fileDownload($id)
    {

        $file = WorkOrderImage::find($id);
        if ($file) {
            $file_path = storage_path('workorder_files/' . $file->image);
            $filename  = $file->file_name;

            return \Response::download(
                $file_path,
                $filename,
                [
                    'Content-Length: ' . filesize($file_path),
                ]
            );
        } else {
            return redirect()->back()->with('error', __('File is not exist.'));
        }
    }


    public function fileDelete($id)
    {
        $file = WorkOrderImage::find($id);
        if ($file) {
            $path = storage_path('workorder_files/' . $file->image);
            if (file_exists($path)) {
                \File::delete($path);
            }
            $file->delete();

            return response()->json(['is_success' => true], 200);
        } else {
            return response()->json(
                [
                    'is_success' => false,
                    'error' => __('File is not exist.'),
                ],
                200
            );
        }
    }

    public function assetsedit($id)
    {
        $assets = Assets::where(['company_id' => Auth::user()->Company_ID(), 'location_id' => User::userCurrentLocation(), 'is_active' => 1])->get()->pluck('name', 'id');
        return view('workorder.assetedit', compact('assets', 'id'));
    }


    public function assetsupdate(Request $request)
    {
        $workorder['assets_id']   = $request->assets_id;
        $workorder = WorkOrder::where('id', $request->wo_id)->update($workorder);

        if ($workorder) {
            return redirect()->back()->with(['success' => __('Asset update successfully.'), 'tab-status' => 'asset']);
        } else {
            return redirect()->back()->with(['error', __('Something went wrong.'), 'tab-status' => 'asset']);
        }
    }


    public function workstatus(Request $request)
    {
        $workorder['work_status']  = $request->work_status;
        $workorder = WorkOrder::where('id', $request->wos_id)->update($workorder);
    }



    public function getChartData($arrParam)
    {
        //work order detail page in curve chart for recent order
        $arrDuration = [];
        $workorder_id = $arrParam['workorder_id'];
        if ($arrParam['duration']) {
            if ($arrParam['duration'] == 'year') {
                for ($i = 0; $i < 12; $i++) {
                    $arrDuration[] = date('F', strtotime("+$i Months"));
                }
            }
        }
        $arrTask          = [];
        $arrTask['label'] = [];
        $arrTask['data']  = [];
        $final_data = 0;
        foreach ($arrDuration as $date => $label) {
            $year = date('Y');

            $data = WosLogTime::select(\DB::raw('sum(hours)+sum(minute/60) as total_hours'))->where('wo_id', $workorder_id)->whereMonth('created_at', date('m', strtotime($label)))->whereYear('created_at', $year)->first();
            if ($data->total_hours != null) {
                $final_data = number_format($data->total_hours, 0);
            } else {
                $final_data = 0;
            }
            $arrTask['label'][] = $label;
            $arrTask['data'][]  = $final_data;
        }
        return $arrTask;
    }


    public function wosimport(){
        return view('workorder.import');
    }


    public function wosimportCreate(Request $request) 
    {
        Excel::import(new WorkorderImport, $request->file('file'));
        return back();
    }
}
