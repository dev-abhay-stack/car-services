<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendor;
use App\Models\User;
use App\Models\VendorLogTime;
use App\Models\Parts;
use App\Models\Assets;
use App\Models\Utility;
use Illuminate\Support\Facades\Validator;
use Auth;
use DB;

class VendorController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (\Auth::user()->can('manage vendor')) {
            $objUser            = Auth::user();
            $Company_ID = $objUser->Company_ID();
            if (Auth::user()->user_type == "company") {
                $Vendor = Vendor::where(['company_id' => $Company_ID, 'location_id' => $objUser->current_location, 'is_active' => 1])->get();
            } else {
                $Vendor = Vendor::where(['company_id' => $Company_ID, 'location_id' => $objUser->location_id, 'is_active' => 1])->get();
            }
            return view('vendors.index', compact('Vendor'));
        } else {
            return redirect()->view()->with('error', __('Permission Denied.'));
        }
    }


    public function create(Request $request, $vendor_id = 0)
    {
        if (\Auth::user()->can('create vendor')) {
            $parts_id = $request->parts_id;
            $assets_id = $request->assets_id;
            return view('vendors.create', compact('vendor_id', 'parts_id', 'assets_id'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function store(Request $request)
    {
        if (\Auth::user()->can('create vendor')) {
            $is_success = false;
            $message = '';

            $objUser            = Auth::user();
            $Company_ID = $objUser->Company_ID();
            $currentlocation = User::userCurrentLocation();

            if ($currentlocation == 0) {
                return redirect()->back()->with('error', __('Current location is not available.'));
            }

            $valid = [
                'name' => 'required',
            ];

            $validator = Validator::make($request->all(), $valid);
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                $response = [
                    'is_success' => $is_success,
                    'message' => $messages->first()
                ];
                return redirect()->back()->with('error', $messages->first());
            }

            $image_name = '';
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $image_name = md5(time()) . "_" . $image->getClientOriginalName();
                $image->storeAs('vendors', $image_name);
            }

            $vendor = Vendor::create([
                'name' => $request->name,
                'contact' => $request->contact,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'image' => $image_name,
                'location_id' => $currentlocation,
                'created_by' => $objUser->id,
                'company_id' => $objUser->Company_ID(),
            ]);

            if ($vendor) {
                $parts_id = $request->parts_id;
                $assets_id = $request->assets_id;

                //parts detail page in associate vendor in craete vendor
                if ($parts_id != 0 && !empty($parts_id)) {

                    $Parts = Parts::where(['id' => $parts_id, 'company_id' => $Company_ID, 'is_active' => 1])->first();

                    if (!is_null($Parts)) {

                        $vendor_id = [];
                        if (!empty($Parts->vendor_id)) {
                            $vendor_id = explode(',', $Parts->vendor_id);
                        }
                        $vendor_id[] = $vendor->id;

                        Parts::where('id', $parts_id)->update(['vendor_id' => implode(',', $vendor_id)]);
                    }
                } elseif ($assets_id != 0 && !empty($assets_id)) {

                    $Assets = Assets::where(['id' => $assets_id, 'company_id' => $Company_ID, 'is_active' => 1])->first();
                    if (!is_null($Assets)) {
                        $vendor_id = [];
                        if (!empty($Assets->vendor_id)) {
                            $vendor_id = explode(',', $Assets->vendor_id);
                        }
                        $vendor_id[] = $vendor->id;

                        Assets::where('id', $assets_id)->update(['vendor_id' => implode(',', $vendor_id)]);
                    }
                }
                return redirect()->back()->with(['success' => __('Vendor created successfully.'), 'tab-status' => 'vendor']);
            } else {
                return redirect()->back()->with(['error' => __('Something went wrong.'), 'tab-status' => 'vendor']);
            }
        } else {
            return redirect()->back()->with('error ', __('Permission Denied.'));
        }
    }


    public function show($id)
    {
        if (\Auth::user()->can('manage vendor')) {
            $Vendor = Vendor::where(['id' => $id])->first();
            $module = "vendors";

            $parts = DB::table('vendors')->leftJoin('parts', function ($join) {
                $join->whereRaw(DB::raw("find_in_set(parts.id,vendors.parts_id)"));
            })->where('parts.id', '!=', null)->where('vendors.id', $Vendor->id)->get();

            $assets = DB::table('vendors')->leftJoin('assets', function ($join) {
                $join->whereRaw(DB::raw("find_in_set(assets.id,vendors.assets_id)"));
            })->where('assets.id', '!=', null)->where('vendors.id', $Vendor->id)->get();

            $vendor_pos = DB::table('pos')
                ->join('users', 'pos.user_id', '=', 'users.id')
                ->join('vendors', 'pos.vendor_id', '=', 'vendors.id')
                ->select(DB::raw('pos.*, users.name as user_name, vendors.name as vendor_name'))
                ->where('pos.vendor_id', $id)
                ->get();

            $vendorlogtime = VendorLogTime::where('vendor_id', $id)->get();
            return view('vendors.detail', compact('Vendor', 'parts', 'module', 'vendorlogtime', 'assets', 'vendor_pos'));
        } else {
        }
    }


    public function edit($id)
    {
        if (\Auth::user()->can('edit vendor')) {
            $Vendor = Vendor::find($id);
            return view('vendors.edit', compact('Vendor'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function update(Request $request, $id)
    {

        if (\Auth::user()->can('edit vendor')) {
            $objUser            = Auth::user();
            $Company_ID = $objUser->Company_ID();
            $currentlocation = User::userCurrentLocation();

            if ($currentlocation == 0) {
                return redirect()->back()->with('error', __('Current location is not available.'));
            }
            $valid = ['name' => 'required'];

            $validator = Validator::make($request->all(), $valid);
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }

            // $image_name = '';
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $image_name = md5(time()) . "_" . $image->getClientOriginalName();
                $image->storeAs('vendors', $image_name);
                $vendor['image'] = $image_name;
            }

            $vendor['name']       = $request->name;
            $vendor['contact']    = $request->contact;
            $vendor['email']      = $request->email;
            $vendor['phone']      = $request->phone;
            $vendor['address']    = $request->address;
            $vendor['location_id'] = $currentlocation;
            $vendor['created_by'] = $objUser->id;
            $vendor['company_id'] = $objUser->Company_ID();

            $vendor = Vendor::where('id', $id)->update($vendor);

            if ($vendor) {
                return redirect()->back()->with('success', __('Vendor update successfully.'));
            } else {
                return redirect()->back()->with('error', __('Something went wrong.'));
            }
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function destroy($id)
    {
        if (\Auth::user()->can('delete vendor')) {
            $vendors = Vendor::find($id);
            if ($vendors) {
                if (\Auth::user()->type == 'super admin') {
                    $vendors->delete();
                } else {
                    $vendors->delete();
                }
                return redirect()->back()->with('success', __('Vendor successfully deleted .'));
            } else {
                return redirect()->back()->with('error', __('Something is wrong.'));
            }
        }
        else
        {
            return redirect()->back()->with('error',__('Permission Deined.'));
        }
    }


    public function associateVendorsView($module, $id)
    {

        $objUser            = Auth::user();
        $Company_ID = $objUser->Company_ID();
        $currentlocation = User::userCurrentLocation();

        //Parts detail page in vendor
        if ($module == 'parts_vendor') {

            if (Auth::user()->can('associate vendor')) {

                if ($currentlocation == 0) {
                    return redirect()->back()->with('error', __('Current location is not available.'));
                }
                $parts = Parts::find($id);

                $vendor = Vendor::where(['company_id' => $Company_ID, 'location_id' => $currentlocation, 'is_active' => 1])->whereNotIn('id', explode(',', $parts->vendor_id))->get()->pluck('name', 'id');

                $parts_id = $id;

                return view('vendors.associate', compact('vendor', 'parts_id', 'id', 'module'));
            } else {
                return redirect()->back()->with('error', __('Permission Denied.'));
            }
        }
        //Asset detail page in associate vendor
        if ($module == 'assets_vendor') {

            if (Auth::user()->can('associate vendor')) {
                if ($currentlocation == 0) {
                    return redirect()->back()->with('error', __('Current location is not available.'));
                }

                $assets = Assets::find($id);
                $vendor = Vendor::where(['company_id' => $Company_ID, 'location_id' => $currentlocation, 'is_active' => 1])->whereNotIn('id', explode(',', $assets->vendor_id))->get()->pluck('name', 'id');
                $parts_id = $id;

                return view('vendors.associate', compact('vendor', 'parts_id', 'id', 'module'));
            } else {
                return redirect()->back()->with('error', __('Permission Denied.'));
            }
        }
    }


    public function associateVendors(Request $request, $module, $id)
    {
        $objUser            = Auth::user();
        $Company_ID = $objUser->Company_ID();
        $currentlocation = User::userCurrentLocation();

        //Parts detail page in associate vendor
        if ($module == 'parts_vendor') {

            $Parts = Parts::where(['id' => $id, 'company_id' => $Company_ID, 'is_active' => 1])->first();
            if (!is_null($Parts)) {

                $parts_vendor_id = empty($Parts->vendor_id) ? implode(',', $request->associate_vendor) : $Parts->vendor_id . ',' . implode(',', $request->associate_vendor);

                $Parts->vendor_id = $parts_vendor_id;
                $Parts->save();

                return redirect()->back()->with(['success' => __('Asset associate to parts successfully.'), 'tab-status' => 'vendor']);
            } else {

                return redirect()->back()->with(['error' => __('Assets is not available.'), 'tab-status' => 'vendor']);
            }
        }
        //Asset detail page in Associate vendor
        elseif ($module == 'assets_vendor') {

            $Assets = Assets::where(['id' => $id, 'company_id' => $Company_ID, 'is_active' => 1])->first();
            if (!is_null($Assets)) {

                $assets_vendor_id =  empty($Assets->vendor_id) ?  implode(',', $request->associate_vendor) : $Assets->vendor_id . ',' . implode(',', $request->associate_vendor);
                $Assets->vendor_id = $assets_vendor_id;
                $Assets->save();

                return redirect()->back()->with(['success' => __('Vendor associate to Asset ssuccessfully.'), 'tab-status' => 'vendor']);
            } else {

                return redirect()->back()->with(['error' => __('Vendor is not available.'), 'tab-status' => 'vendor']);
            }
        } else {
            return redirect()->back()->with('error', __('Something went to wrong.'));
        }
    }


    public function removeAssociateVendors(Request $request, $module, $id)
    {
        //Parts detail page in associated vendor remove
        if ($module == "parts_vendor") {
            $Parts = Parts::where(['id' => $request->vendor_id, 'is_active' => 1])->first();
            $parts_vendor_id = explode(',', $Parts->vendor_id);
            unset($parts_vendor_id[array_search($id, $parts_vendor_id)]);
            $parts_vendor_id = array_filter($parts_vendor_id);
            $Parts->vendor_id = implode(',', $parts_vendor_id);
            $Parts->save();
            return redirect()->back()->with(['success' => __('Vendor successfully deleted.'), 'tab-status' => 'vendor']);
        }
        //Asset detail page in associated vendor remove
        elseif ($module == "assets_vendor") {
            $Assets = Assets::where(['id' => $request->assets_id, 'is_active' => 1])->first();
            $assets_vendor_id = explode(',', $Assets->vendor_id);
            unset($assets_vendor_id[array_search($id, $assets_vendor_id)]);

            $assets_vendor_id = array_filter($assets_vendor_id);

            $Assets->vendor_id = implode(',', $assets_vendor_id);

            $Assets->save();

            return redirect()->back()->with(['success' => __('Vendor successfully deleted.'), 'tab-status' => 'vendor']);
        } else {
            return redirect()->back()->with(['error' => __('Something went to wrong.'), 'tab-status' => 'vendor']);
        }
    }
}
