<?php

namespace App\Http\Controllers;

use App\Models\Parts;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Utility;
use App\Models\Assets;
use App\Models\Pms;
use App\Models\Vendor;
use App\Models\PartsLogTime;
use App\Models\Pos;
use App\Models\PosPart;
use App\Models\WorkOrder;

use DB;
use Illuminate\Support\Facades\File;

class PartsController extends Controller
{

    public function index()
    {
        if (Auth::user()->can('manage parts')) {
            $objUser            = Auth::user();
            $Company_ID = $objUser->Company_ID();

            $currentlocation = User::userCurrentLocation();
            $parts = Parts::where(['company_id' => $Company_ID, 'location_id' => $currentlocation, 'is_active' => 1])->get();

            return view('parts.index', compact('parts'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function create(Request $request)
    {
        if (\Auth::user()->can('create parts')) {
            $assets_id = $request->assets_id;
            $pms_id = $request->pms_id;
            $vendor_id = $request->vendor_id;
            $open_task_id = $request->open_task_id;

            $objUser            = Auth::user();
            $Company_ID = $objUser->Company_ID();
            return view('parts.create', compact('assets_id', 'pms_id', 'vendor_id', 'open_task_id'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function store(Request $request)
    {
        if (\Auth::user()->can('create parts')) {
            $objUser            = Auth::user();
            $Company_ID = $objUser->Company_ID();
            $currentlocation = User::userCurrentLocation();
            if ($currentlocation == 0) {
                return redirect()->back()->with('error', __('Current location is not available.'));
            }

            $valid = ['name' => 'required', 'thumbnail' => 'required|image|mimes:png,jpeg,jpg|max:20480'];

            $validator = Validator::make($request->all(), $valid);
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }

            $thumbnail_name = '';
            if ($request->hasFile('thumbnail')) {
                $thumbnail = $request->file('thumbnail');
                $thumbnail_name = md5(time()) . "_" . $thumbnail->getClientOriginalName();
                $thumbnail->storeAs('Parts/thumbnail', $thumbnail_name);
            }

            $parts = Parts::create([
                'name' => $request->name,
                'thumbnail' => $thumbnail_name,
                'number' => $request->number,
                'quantity' => $request->quantity,
                'price' => $request->price,
                'category' => $request->category,
                'location_id' =>  $currentlocation,
                'created_by' => $objUser->id,
                'company_id' => $objUser->Company_ID(),
            ]);

            if ($parts) {

                $assets_id = $request->assets_id;
                $pms_id = $request->pms_id;
                $vendor_id = $request->vendor_id;
                $open_task_id = $request->open_task_id;
                if ($assets_id != 0 && !empty($assets_id)) {

                    $Assets = Assets::where(['id' => $assets_id, 'company_id' => $Company_ID, 'is_active' => 1])->first();
                    if (!is_null($Assets)) {
                        $parts_id = [];
                        if (!empty($Assets->parts_id)) {
                            $parts_id = explode(',', $Assets->parts_id);
                        }
                        $parts_id[] = $parts->id;

                        Assets::where('id', $assets_id)->update(['parts_id' => implode(',', $parts_id)]);
                    }
                }
                //pms detail page in parts create
                elseif ($pms_id != 0 && !empty($pms_id)) {

                    $Pms = Pms::where(['id' => $pms_id, 'company_id' => $Company_ID, 'is_active' => 1])->first();
                    if (!is_null($Pms)) {
                        $parts_id = [];
                        if (!empty($Pms->parts_id)) {
                            $parts_id = explode(',', $Pms->parts_id);
                        }
                        $parts_id[] = $parts->id;
                        Pms::where('id', $pms_id)->update(['parts_id' => implode(',', $parts_id)]);
                    }
                } elseif ($vendor_id != 0 && !empty($vendor_id)) {

                    $Vendor = Vendor::where(['id' => $vendor_id, 'company_id' => $Company_ID, 'is_active' => 1])->first();
                    if (!is_null($Vendor)) {
                        $parts_id = [];
                        if (!empty($Vendor->parts_id)) {
                            $parts_id = explode(',', $Vendor->parts_id);
                        }
                        $parts_id[] = $parts->id;
                        Vendor::where('id', $vendor_id)->update(['parts_id' => implode(',', $parts_id)]);
                    }
                } 
                //work order deatil page in parts create
                elseif ($open_task_id != 0 && !empty($open_task_id)) {

                    $WorkOrder = WorkOrder::where(['id' => $open_task_id, 'company_id' => $Company_ID,'is_active' => 1])->first();
                    if (!is_null($WorkOrder)) {
                        $parts_id = [];
                        if (!empty($WorkOrder->parts_id)) {
                            $parts_id = explode(',', $WorkOrder->parts_id);
                        }
                        $parts_id[] = $parts->id;

                        WorkOrder::where('id', $open_task_id)->update(['parts_id' => implode(',', $parts_id)]);
                    }
                }
                return redirect()->back()->with(['success' => __('Parts created successfully.'), 'tab-status' => 'parts']);
            } else {
                return redirect()->back()->with(['error' => __('Something went wrong.'), 'tab-status' => 'parts']);
            }
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function show($id)
    {
        if (\Auth::user()->can('manage parts')) {
            $Parts = Parts::where(['id' => $id])->first();
            $module = "parts";

            $vendor = DB::table('parts')->leftJoin('vendors', function ($join) {
                $join->whereRaw(DB::raw("find_in_set(vendors.id,parts.vendor_id)"));
            })->where('vendors.id', '!=', null)->where('parts.id', $Parts->id)->get();

            $assets = DB::table('parts')->leftJoin('assets', function ($join) {
                $join->whereRaw(DB::raw("find_in_set(assets.id,parts.assets_id)"));
            })->where('assets.id', '!=', null)->where('parts.id', $Parts->id)->get();

            $partslogtime = PartsLogTime::where('parts_id', $id)->get();

            $parts_pos = DB::table('pos')
                ->join('users', 'pos.user_id', '=', 'users.id')
                ->join('vendors', 'pos.vendor_id', '=', 'vendors.id')
                ->select(DB::raw('pos.*, users.name as user_name, vendors.name as vendor_name'))
                ->where('pos.parts_id', $id)
                ->get();

            $total_parts_purchase = PosPart::where('parts_id', $id)->count();
            $total_cost = PosPart::select(DB::raw('SUM(price*quantity+(price*quantity*tax/100)-discount) as total_cost'))->where('parts_id', $id)->first();


            return view('parts.detail', compact('Parts', 'module', 'partslogtime', 'vendor', 'assets', 'parts_pos', 'total_parts_purchase', 'total_cost'));
        } else {
            return redirect()->back()->with('error', __("Permission Denied"));
        }
    }


    public function edit(Parts $parts, $id)
    {
        if (\Auth::user()->can('edit parts')) {
            $parts = Parts::where('id', $id)->first();
            return view('parts.edit', compact('parts'));
        } else {
            return redirect()->back()->with('error', __("Permission Denied."));
        }
    }


    public function update(Request $request, $id)
    {
        if (\Auth::user()->can('edit parts')) {

            $objUser            = Auth::user();
           
            $currentlocation = User::userCurrentLocation();
            if ($currentlocation == 0) {
                return redirect()->back()->with('error', __('Current location is not available.'));
            }

            $thumbnail_name = '';
            if ($request->hasFile('thumbnail')) {

                $part = Parts::where('id', $id)->first();
                $thumbnail_file = storage_path('Parts/thumbnail/' . $part->thumbnail);
                if ($thumbnail_file) {
                    unlink($thumbnail_file);
                }

                $valid = ['name' => 'required', 'thumbnail' => 'required|image|mimes:png,jpeg,jpg|max:20480'];
                $validator = Validator::make($request->all(), $valid);
                if ($validator->fails()) {
                    $messages = $validator->getMessageBag();
                    return redirect()->back()->with('error', $messages->first());
                }
                $thumbnail = $request->file('thumbnail');
                $thumbnail_name = md5(time()) . "_" . $thumbnail->getClientOriginalName();
                $thumbnail->storeAs('Parts/thumbnail', $thumbnail_name);
                $parts['thumbnail']  = $thumbnail_name;
            }

            $parts['name']       = $request->name;
            $parts['number']     = $request->number;
            $parts['quantity']   = $request->quantity;
            $parts['price']      = $request->price;
            $parts['category']   = $request->category;
            $parts['location_id'] = $currentlocation;
            $parts['created_by'] = $objUser->id;
            $parts['company_id'] = $objUser->Company_ID();


            $parts = Parts::where('id', $id)->update($parts);
            if ($parts) {
                return redirect()->back()->with('success', __('Parts Update Successfully'));
            } else {
                return redirect()->back()->with('error', __('Something Went Wrong'));
            }
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function destroy($id)
    {
        if (\Auth::user()->can('delete parts')) {
            $parts = Parts::find($id);
            if ($parts) {
                $thumbnail_file = storage_path('Parts/thumbnail/' . $parts->thumbnail);
                if ($thumbnail_file) {
                    unlink($thumbnail_file);
                }
                $parts->delete();
                return redirect()->route('parts.index')->with('success', __('Parts successfully deleted.'));
            } else {
                return redirect()->back()->with('error', __('Something is wrong.'));
            }
        } else {
            return redirect()->error('error', __('Permission Denied'));
        }
    }


    public function associatePartsView($module, $id)
    {

        $objUser            = Auth::user();
        $Company_ID = $objUser->Company_ID();
        $currentlocation = User::userCurrentLocation();

        //Asset detail page in parts
        if ($module == 'parts') {

            if (Auth::user()->can('associate parts')) {
                if ($currentlocation == 0) {
                    return redirect()->back()->with('error', __('Current location is not available.'));
                }
                $assets_parts = Assets::find($id);
                $parts = Parts::where(['company_id' => $Company_ID, 'location_id' => $currentlocation, 'is_active' => 1])->whereNotIn('id', explode(',', $assets_parts->parts_id))->get()->pluck('name', 'id');
                return view('parts.associate', compact('parts', 'id', 'module'));
            } else {
                return redirect()->back()->with('error', __('Permission Denied.'));
            }
        }
        //Asset detail page in pms
        elseif ($module == 'pms') {
            if (Auth::user()->can('associate pms')) {
                if ($currentlocation == 0) {
                    return redirect()->back()->with('error', __('Current location is not available.'));
                }
                $pms_parts = Assets::find($id);
                $parts = Pms::where(['company_id' => $Company_ID, 'location_id' => $currentlocation, 'is_active' => 1])->whereNotIn('id', explode(',', $pms_parts->pms_id))->get()->pluck('name', 'id');
                return view('parts.associate', compact('parts', 'id', 'module'));
            } else {
                return redirect()->back()->with('error', __('Permission Denied.'));
            }
        }
        //pms detail page in parts
        if ($module == 'pms_parts') {
            if (Auth::user()->can('associate parts')) {
                if ($currentlocation == 0) {
                    return redirect()->back()->with('error', __('Current location is not available.'));
                }
                $pms_parts = Pms::find($id);
                $parts = Parts::where(['company_id' => $Company_ID, 'location_id' => $currentlocation, 'is_active' => 1])->whereNotIn('id', explode(',', $pms_parts->parts_id))->get()->pluck('name', 'id');
                $pms_id = $id;
                return view('parts.associate', compact('parts', 'pms_id', 'id', 'module'));
            } else {
                return redirect()->back()->with('error', __('Permission Denied.'));
            }
        }
        //vendors detail page in parts
        if ($module == 'vendors') {
            if (Auth::user()->can('associate parts')) {
                if ($currentlocation == 0) {
                    return redirect()->back()->with('error', __('Current location is not available.'));
                }
                $vendor_parts = Vendor::find($id);
                $parts = Parts::where(['company_id' => $Company_ID, 'location_id' => $currentlocation, 'is_active' => 1])->whereNotIn('id', explode(',', $vendor_parts->parts_id))->get()->pluck('name', 'id');
                $data_id = $id;
                return view('parts.associate', compact('parts', 'data_id', 'id', 'module'));
            } else {
                return redirect()->back()->with('error', __('Permission Denied.'));
            }
        }
        //work order deatil page in parts
        if ($module == 'open_task') {
            if (Auth::user()->can('associate parts')) {
                if ($currentlocation == 0) {
                    return redirect()->back()->with('error', __('Current location is not available.'));
                }
                $wo_parts = WorkOrder::find($id);
                $parts = Parts::where(['company_id' => $Company_ID, 'location_id' => $currentlocation, 'is_active' => 1])->whereNotIn('id', explode(',', $wo_parts->parts_id))->get()->pluck('name', 'id');
                $data_id = $id;
                return view('parts.associate', compact('parts', 'data_id', 'id', 'module'));
            }
            else
            {
                return redirect()->back()->with('error',__('Permission Denied.'));
            }
        }
    }


    public function associateParts(Request $request, $module, $id)
    {
        $valid = ['associate_parts' => 'required'];

        $validator = Validator::make($request->all(), $valid);
        if ($validator->fails()) {
            $messages = $validator->getMessageBag();
            return redirect()->back()->with('error', $messages->first());
        }

        $objUser            = Auth::user();
        $Company_ID = $objUser->Company_ID();
        $currentlocation = User::userCurrentLocation();

        //Asset Detail page in parts
        if ($module == 'parts') {

            $Assets = Assets::where(['id' => $id, 'company_id' => $Company_ID, 'is_active' => 1])->first();
            if (!is_null($Assets)) {
                $assets_part_id = empty($Assets->parts_id) ? implode(',', $request->associate_parts) : $Assets->parts_id . ',' . implode(',', $request->associate_parts);
                $Assets->parts_id = $assets_part_id;
            
                $Assets->save();

                return redirect()->back()->with(['success' => __('Parts associate to assets successfully.'), 'tab-status' => 'parts']);
            } else {

                return redirect()->back()->with(['error' => __('Parts is not available.'), 'tab-status' => 'parts']);
            }
        }
        //Asset Detail page in pms
        elseif ($module == 'pms') {

            $Pms = Assets::where(['id' => $id, 'company_id' => $Company_ID, 'is_active' => 1])->first();
            if (!is_null($Pms)) {

                $pms_part_id = empty($Pms->pms_id) ? implode(',', $request->associate_parts) : $Pms->pms_id . ',' . implode(',', $request->associate_parts);
                $Pms->pms_id = $pms_part_id;
                $Pms->save();

                return redirect()->back()->with(['success' => __('Pms associate to Asset successfully.'), 'tab-status' => 'pms']);
            } else {

                return redirect()->back()->with(['error' => __('Pms is not available.'), 'tab-status' => 'pms']);
            }
        }
        //pms detail page in part
        elseif ($module == 'pms_parts') {
            $pms = Pms::where(['id' => $id, 'company_id' => $Company_ID, 'is_active' => 1])->first();

            if (!is_null($pms)) {
                $parts_id = empty($pms->parts_id) ? implode(',', $request->associate_parts) : $pms->parts_id . ',' . implode(',', $request->associate_parts);
                $pms->parts_id = $parts_id;
                $pms->save();
                return redirect()->back()->with(['success' => __('Parts associate to pms successfully.'), 'tab-status' => 'parts']);
            } else {
                return redirect()->back()->with(['error' => 'Parts is not available.', 'tab-status' => 'parts']);
            }
        }
        //vendors deatil page in part
        elseif ($module == 'vendors') {

            $Vendor = Vendor::where(['id' => $id, 'company_id' => $Company_ID, 'is_active' => 1])->first();
            if (!is_null($Vendor)) {

                $vendor_part_id = empty($Vendor->parts_id) ? implode(',', $request->associate_parts) :  $Vendor->parts_id . ',' . implode(',', $request->associate_parts);
                $Vendor->parts_id = $vendor_part_id;
                $Vendor->save();

                return redirect()->back()->with(['success' => __('Parts associate to vendor successfully.'), 'tab-status' => 'parts']);
            } else {

                return redirect()->back()->with(['error' => __('Parts is not available.'), 'tab-status' => 'parts']);
            }
        }
        //workorder detail page in part
         elseif ($module == 'open_task') {
                
            $Workorder = WorkOrder::where(['id' => $id, 'company_id' => $Company_ID,'is_active' => 1])->first();
            if (!is_null($Workorder)) {

                $wo_part_id = empty($Workorder->parts_id) ?  implode(',', $request->associate_parts) : $Workorder->parts_id . ',' . implode(',', $request->associate_parts);
                $Workorder->parts_id = $wo_part_id;      
                $Workorder->save();

                return redirect()->back()->with(['success' => __('Parts associate to Open Task successfully.'), 'tab-status' => 'parts']);
            } else {

                return redirect()->back()->with(['error' => __('Assets is not available.'), 'tab-status' => 'parts']);
            }
        } else {
            return redirect()->back()->with(['error' => __('Something went to wrong.'), 'tab-status' => 'parts']);
        }
    }


    public function removeAssociateParts(Request $request, $module, $id)
    {
        //Asset Detail page in parts
        if ($module == "assets") {
            $Assets = Assets::where(['id' => $request->assets_id, 'is_active' => 1])->first();
            $asset_part_id = explode(',', $Assets->parts_id);
            unset($asset_part_id[array_search($id, $asset_part_id)]);
            $asset_part_id = array_filter($asset_part_id);
            $Assets->parts_id = implode(',', $asset_part_id);
            $Assets->save();
            return redirect()->back()->with(['success' => __('Parts successfully deleted.'), 'tab-status' => 'parts']);
        }
        //Asset Detail Page in pms
        elseif ($module == "pms") {

            $Assets = Assets::where(['id' => $request->assets_id, 'is_active' => 1])->first();
            $pms_part_id = explode(',', $Assets->pms_id);
            unset($pms_part_id[array_search($id, $pms_part_id)]);
            $pms_part_id = array_filter($pms_part_id);
            $Assets->pms_id = implode(',', $pms_part_id);
            $Assets->save();
            return redirect()->back()->with(['success' => __('Pms successfully deleted.'), 'tab-status' => 'pms']);
        }
        //pms detail page in parts
        elseif ($module == 'pms_part') {
            $Pms = Pms::where(['id' => $request->pms_id, 'is_active' => 1])->first();
            $pms_part_id = explode(",", $Pms->parts_id);
            unset($pms_part_id[array_search($id, $pms_part_id)]);
            $pms_part_id = array_filter($pms_part_id);
            $Pms->parts_id = implode(",", $pms_part_id);
            $Pms->save();
            return redirect()->back()->with(['success' => __('Parts successfullt deleted.'), 'tab-status' => 'parts']);
        }
        //vendros detail page in parts
        elseif ($module == "vendors") {

            $Vendor = Vendor::where(['id' => $request->vendor_id, 'is_active' => 1])->first();
            $vendor_part_id = explode(',', $Vendor->parts_id);
            unset($vendor_part_id[array_search($id, $vendor_part_id)]);
            $vendor_part_id = array_filter($vendor_part_id);
            $Vendor->parts_id = implode(',', $vendor_part_id);
            $Vendor->save();
            return redirect()->back()->with(['success' => __('Part successfully deleted.'), 'tab-status' => 'parts']);
        } 
        //work order detail page in parts
        elseif ($module == "open_task") {

            $Workorder = WorkOrder::where(['id' => $request->open_task_id,'is_active' => 1])->first();
            $wo_part_id = explode(',', $Workorder->parts_id);
            unset($wo_part_id[array_search($id, $wo_part_id)]);
            $wo_part_id=array_filter($wo_part_id);
            $Workorder->parts_id = implode(',', $wo_part_id);
            $Workorder->save();
            return redirect()->back()->with(['success' => __('Part successfully deleted.'), 'tab-status' => 'parts']);
        }
    }
}
