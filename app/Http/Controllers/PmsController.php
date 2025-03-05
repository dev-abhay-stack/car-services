<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Pms;
use App\Models\Parts;
use App\Models\Form;
use App\Models\Assets;
use App\Models\PmsLogTime;
use App\Models\PmsInvoice;
use Auth;
use DB;

class PmsController extends Controller
{

    public function index()
    {

        if (Auth::user()->can('manage pms')) {
            $objUser            = Auth::user();
            $Company_ID = $objUser->Company_ID();
            if (Auth::user()->user_type == "company") {
                $pms = Pms::where(['company_id' => $Company_ID, 'location_id' => $objUser->current_location, 'is_active' => 1])->get();
            } else {
                $pms = Pms::where(['company_id' => $Company_ID, 'location_id' => $objUser->location_id, 'is_active' => 1])->get();
            }


            return view('pms.index', compact('pms'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function create($assets_id = 0)
    {

        if (Auth::user()->can('create pms')) {
            $parts = Parts::where(['company_id' => Auth::user()->Company_ID(), 'location_id' => User::userCurrentLocation(), 'is_active' => 1])->get()->pluck('name', 'id');
            return view('pms.create', compact('parts', 'assets_id'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function store(Request $request)
    {

        if (Auth::user()->can('create pms')) {
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

            $pms = Pms::create([
                'name' => $request->name,
                'location_id' => $currentlocation,
                'description' => $request->description,
                'parts_id' => implode(',', $request->parts),
                'tags' => $request->tags,
                'created_by' => $objUser->id,
                'company_id' => $objUser->Company_ID(),
                'is_active'=>1
            ]);

            $form = Form::create([
                'pms_id' => $pms->id,
                'json' => "[]",
                'created_by' => $objUser->id,
                'company_id' => $objUser->Company_ID(),
            ]);

            if ($pms) {
                $assets_id = $request->assets_id;

                if ($assets_id != 0 && !empty($assets_id)) {
                    $Assets = Assets::where(['id' => $assets_id, 'company_id' => $Company_ID, 'is_active' => 1])->first();
                    if (!is_null($Assets)) {

                        $pms_id = [];
                        if (!empty($Assets->pms_id)) {
                            $pms_id = explode(',', $Assets->pms_id);
                        }
                        $pms_id[] = $pms->id;
                
                        $Assets=Assets::where('id',$assets_id)->update(['pms_id'=>implode(",",$pms_id)]);
                    }
                }
                return redirect()->back()->with(['success' => __('PMs created successfully.'), 'tab-status' => 'pms']);
            } else {
                return redirect()->back()->with(['error' => __('Something went wrong.'), 'tab-status' => 'pms']);
            }

            return redirect()->back()->with(['success' => __('PMs created successfully.'), 'tab-status' => 'pms']);
        } else {
            return redirect()->back()->with(['error' => __('Permission Denied.'), 'tab-status' => 'pms']);
        }
    }


    public function show($id)
    {
        if (Auth::user()->can('manage pms')) {
            $Pms = Pms::where(['id' => $id])->first();
            if (!is_null($Pms) && $Pms->is_active) {

                $module = "pms_part";
        
                // $AssetsField = DB::table('assets_field_values')->leftJoin('assets_fields','assets_field_values.field_id', '=', 'assets_fields.id')->where(['record_id' => $id])->get();

                $parts = DB::table('pms')->leftJoin('parts', function ($join) {
                    $join->whereRaw(DB::raw("find_in_set(parts.id,pms.parts_id)"));
                })->where('parts.id', '!=', null)->where('pms.id', $Pms->id)->get();

                // $form = Form::find(1);
                $form = Form::where('pms_id', $id)->get();
                $pmslogtime = PmsLogTime::where('pms_id', $id)->get();
                $pmsinvoice = PmsInvoice::where('pms_id', $id)->get();

                $Pms_tag = explode(',', $Pms->tags);

                $instruction=Form::where('pms_id',$id)->first();
                $view_instruction=json_decode($instruction->json);

                return view('pms.detail', compact('Pms', 'parts', 'form', 'module', 'pmslogtime', 'pmsinvoice', 'Pms_tag','view_instruction'));
            } else {
                return redirect()->back()->with('error', __('Permission Denied.'));
            }
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function edit(Request $request, $id)
    {
        if (Auth::user()->can('edit pms')) {
            $parts = Parts::where(['company_id' => Auth::user()->Company_ID(), 'location_id' => User::userCurrentLocation(), 'is_active' => 1])->get()->pluck('name', 'id');
            $pms = Pms::where('id', $id)->get();
            $pms_role = explode(',', $pms[0]['parts_id']);
            return view('pms.edit', compact('pms', 'parts', 'pms_role'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function update(Request $request, $id)
    {

        if (Auth::user()->can('edit pms')) {

            $objUser            = Auth::user();
            $Company_ID = $objUser->Company_ID();
            $currentlocation = User::userCurrentLocation();
            if ($currentlocation == 0) {
                return redirect()->back()->with(['error' => __('Current location is not available.'), 'tab-status' => 'pms']);
            }
            $valid = ['name' => 'required'];

            $validator = Validator::make($request->all(), $valid);
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }

            $pms['name']       = $request->name;
            $pms['description']       = $request->description;
            $pms['parts_id'] = implode(',', $request->parts);
            $pms['tags']       = $request->tags;

            $pms = Pms::where('id', $id)->update($pms);

            return redirect()->back()->with(['success' => __('PMs updated successfully.'), 'tab-status' => 'pms']);
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function destroy($id)
    {
        if (Auth::user()->can('delete pms')) {
            $pms = Pms::find($id);
            $Form = Form::where('pms_id', $id)->first();

            if ($pms) {
                if (\Auth::user()->type == 'super admin') {
                    $pms->delete();
                    $Form->delete();
                } else {
                    $pms->delete();
                    $Form->delete();
                }
                return redirect()->route('pms.index')->with(['success' => __('PMs successfully deleted .'), 'tab-status' => 'pms']);
            } else {
                return redirect()->back()->with(['error' => __('Something is wrong.'), 'tab-status' => 'pms']);
            }
        }
        else
        {
            return redirect()->back()->with('error',__('Permission Denied.'));
        }
    }
}
