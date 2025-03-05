<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Assets;
use App\Models\AssetsField;
use App\Models\Utility;
use App\Models\AssetsFieldValues;
use App\Models\User;
use App\Models\Vendor;
use App\Models\Parts;
use App\Models\AssetsLogTime;
use App\Models\WorkOrder;
use DB;

class AssetsController extends Controller
{

    public function index()
    {
      
        if (\Auth::user()->can('manage assets')) {
          
            $objUser            = Auth::user();
            $Company_ID = $objUser->Company_ID();
            if ($objUser->user_type == "company") {
     
                //company asset 
                $assets = Assets::where(['company_id' => $Company_ID, 'location_id' => $objUser->current_location, 'is_active' => 1])->get();
            } else {

                //log in employee asset
                $assets = Assets::where('company_id', $Company_ID)->where('location_id', $objUser->location_id)->where('is_active', 1)->get();
            }
            return view('assets.index', compact('assets'));
        } else {
            return redirect()->back()->with('error', __('Asset View Permission Denied.'));
        }
    }


    public function create(Request $request)
    {
        if (\Auth::user()->can('create assets')) {
            $parts_id = $request->parts_id;
            $vendor_id=$request->vendor_id;
            $AssetsField = AssetsField::where(['module' => 'Assets'])->get();
            return view('assets.create', compact('AssetsField', 'parts_id','vendor_id'));
        } else {
            return redirect()->back()->with('error', __('Asset Create Permission Denied.'));
        }
    }


    public function store(Request $request)
    {
        
        $is_success = false;
        $message = '';
        if (\Auth::user()->can('create assets')) {

            $objUser            = Auth::user();
            $Company_ID = $objUser->Company_ID();
            $currentlocation = User::userCurrentLocation();
            if ($currentlocation == 0) {
                return redirect()->back()->with('error', __('Current location is not available.'));
            }
            if ($request->thumbnail) {
                $valid = ['name' => 'required', 'thumbnail' => 'required|image|mimes:png,jpeg,jpg|max:20480'];
            }
            if ($request->Waste_Disposal_National_Regulations) {
                foreach ($request->Waste_Disposal_National_Regulations['Waste Disposal National Regulations'] as $file_key => $val) {

                    $valid = [$file_key => 'required|mimes:png,jpeg,jpg,pdf,doc,txt,xls,csv,application/octet-stream,audio/mpeg,mpga,mp3,wav|max:20480'];
                }
            } else {
                $valid = ['name' => 'required', 'Waste_Disposal_National_Regulations' => 'required|mimes:png,jpeg,jpg,pdf,doc,txt,xls,csv,application/octet-stream,audio/mpeg,mpga,mp3,wav|max:20480'];
            }

            $validator = Validator::make($request->all(), $valid);
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                $response = [
                    'is_success' => $is_success,
                    'message' => $messages->first()
                ];

                return redirect()->back()->with('error', $response['message']);
            }


            $thumbnail_name = '';
            if ($request->hasFile('thumbnail')) {
                $thumbnail = $request->file('thumbnail');
                $thumbnail_name = md5(time()) . "_" . $thumbnail->getClientOriginalName();
                $thumbnail->storeAs('Assets/thumbnail', $thumbnail_name);
            }

           
            $assets = Assets::create([
                'name' => $request->name,
                'thumbnail' => $thumbnail_name,
                'location_id' => $currentlocation,
                'created_by' => $objUser->id,
                'company_id' => $objUser->Company_ID(),
            ]);


            if ($assets) {
                $parts_id = $request->parts_id;
                $vendor_id=$request->vendor_id;

                //parts detail page in asset created that time asset table in entry insert and parts in asset_id update
                if ($parts_id != 0 && !empty($parts_id)) {
                    $Parts = Parts::where(['id' => $parts_id, 'company_id' => $Company_ID, 'is_active' => 1])->first();
                    if (!is_null($Parts)) {
                        $assets_id = [];
                        if (!empty($Parts->assets_id)) {
                            $assets_id = explode(',', $Parts->assets_id);
                        }
                        $assets_id[] = $assets->id;
                        $Parts->update(['assets_id' => implode(',', $assets_id)]);
                    }
                }

                //vendors detail page in asset in associated assets in create assets
                if($vendor_id !=0 && !empty($vendor_id))
                {
                    $vendors=Vendor::where(['id'=>$vendor_id,'company_id'=>$Company_ID,'is_active'=>1])->first();
                    if(!is_null($vendors)){
                        $asset_id=[];
                        
                        if(!empty($vendors->assets_id))
                        {
                            $asset_id=explode(",",$vendors->assets_id);
                            
                        }
                        $asset_id[]=$assets->id;
                        $vendors->update(['assets_id' => implode(',', $asset_id)]);
                    }
                }

                $post = $request->all();
                unset($post['_token'], $post['name']);

                foreach ($post as $key => $data) {
                    if (gettype($data) == 'array') {

                        $data_val = array_values($data);
                        $data_id = array_keys($data);
                        if (count($data_id)) {
                            $AssetsField = AssetsField::where(['is_active' => 1, 'name' => $data_id[0], 'module' => 'Assets'])->first();
                            if (!is_null($AssetsField)) {

                                $data_val = $data[$data_id[0]];
            
                                if (!empty($data_val) && $data_val != 'undefined') {

                                    if ($AssetsField->type == 'date') {
                                        $data_val = date("Y-m-d", strtotime($data_val));
                                    }

                                    if (is_file($data_val)) {
                                        $file_name = $data_val->getClientOriginalName();
                                        $file_path = $assets->id . "_" . md5(time()) . "_" . $data_val->getClientOriginalName();
                                        $data_val->storeAs('Assets', $file_path);
                                        $data_val = $file_path;
                                    }

                                    $custom_field_values = AssetsFieldValues::create([
                                        'record_id' => $assets->id,
                                        'field_id' => $AssetsField->id,
                                        'value' => $data_val,
                                        'created_by' => $objUser->id,
                                        'company_id' => $Company_ID,
                                    ]);
                                }
                            }
                        }
                    }
                }

                $is_success = true;
                $message = __('Assets created successfully.');

                return redirect()->back()->with('success', __('Assets created successfully.'));
            } else {
                $message = __('Something went wrong.');
                return redirect()->back()->with('error', __('Something went wrong.'));
            }
        } else {
            $message = __('Permission Denied.');
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function show($id)
    {
        
        if (Auth::user()->can('manage assets')) {
            $Assets = Assets::where(['id' => $id])->first();

            if (!is_null($Assets) && $Assets->is_active) {
                $module_assets = 'assets';
                $module_pms = 'pms';


                $AssetsField = DB::table('assets_field_values')->leftJoin('assets_fields', 'assets_field_values.field_id', '=', 'assets_fields.id')->where(['record_id' => $id])->get();

                $parts = DB::table('assets')->leftJoin('parts', function ($join) {
                    $join->whereRaw(DB::raw("find_in_set(parts.id,assets.parts_id)"));
                })->where('parts.id', '!=', null)->where('assets.id', $Assets->id)->get();


                $pms = DB::table('assets')->leftJoin('pms', function ($join) {
                    $join->whereRaw(DB::raw("find_in_set(pms.id,assets.pms_id)"));
                })->where('pms.id', '!=', null)->where('assets.id', $Assets->id)->get();


                $vendor = DB::table('assets')->leftJoin('vendors', function ($join) {
                    $join->whereRaw(DB::raw("find_in_set(vendors.id,assets.vendor_id)"));
                })->where('vendors.id', '!=', null)->where('assets.id', $Assets->id)->get();

                $wos = WorkOrder::where('assets_id', $id)->get();

                $chartData = $this->getChartData(['duration' => 'year', 'asset_id' => $id]);

                $Assets_file = AssetsFieldValues::where(['record_id' => $id, 'field_id' => 15])->get();
                $Asset_waste_disposal_national_regulations=AssetsFieldValues::where(['record_id'=>$id,'field_id'=>14])->first();
            
                // dd($Assets_file);
                $assetslogtime = AssetsLogTime::where(['assets_id' => $id])->get();

                $barcode  = [
                    'barcodeType' =>  'Data Matrix',
                    'barcodeFormat' => 'css' ,
                    'link' =>   route('asset.show',[$id]),
    
    
                ];
                

                return view('assets.detail', compact('Assets', 'AssetsField', 'parts', 'pms', 'module_assets', 'module_pms', 'Assets_file', 'vendor', 'assetslogtime', 'wos', 'chartData','Asset_waste_disposal_national_regulations','barcode'));
            }
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function edit($id)
    {
        if (Auth::user()->can('edit assets')) {
            $AssetsField = AssetsField::where(['module' => 'Assets'])->get();
            $Assets = Assets::where('id', $id)->first();

            $Assetsfieldvalues = DB::table('assets_field_values')
                ->join('assets_fields', 'assets_field_values.field_id', '=', 'assets_fields.id')
                ->where('record_id', $id)
                ->get();

            foreach ($Assetsfieldvalues as $Assets_Field_Values) {
                $AssetsField_Values[] = [$Assets_Field_Values->name => $Assets_Field_Values->value];
            }
            $AssetsFieldValues = array_merge(...$AssetsField_Values);


            return view('assets.edit', compact('Assets', 'AssetsField', 'AssetsFieldValues'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function update(Request $request, $id)
    {
        if (Auth::user()->can('edit assets')) {
            $objUser            = Auth::user();
            $Company_ID = $objUser->Company_ID();
            $currentlocation = User::userCurrentLocation();

            if ($request->hasFile('thumbnail')) {
                $thumbnail = $request->file('thumbnail');
                $thumbnail_name = md5(time()) . "_" . $thumbnail->getClientOriginalName();
                $thumbnail->storeAs('Assets/thumbnail', $thumbnail_name);
                $assets['thumbnail'] = $thumbnail_name;
            }
            if ($request->name) {
                $assets['name'] = $request->name;
            }

            $assets['location_id'] = $currentlocation;
            $assets['created_by'] = $objUser->id;
            $assets['company_id'] = $objUser->Company_ID();
            Assets::where('id', $id)->update($assets);


            $post = $request->all();

            $Assetsfieldvalues = DB::table('assets_field_values')
                ->join('assets_fields', 'assets_field_values.field_id', '=', 'assets_fields.id')
                ->where('record_id', $id)
                ->get();


            $post = $request->all();
            unset($post['_token'], $post['name'], $post['_method']);


            foreach ($post as $datas) {

                foreach ($Assetsfieldvalues as $Assetsfield_values) {

                    if (array_key_exists($Assetsfield_values->name, $datas)) {

                        $data['value'] = $datas[$Assetsfield_values->name];

                        AssetsFieldValues::where('record_id', $Assetsfield_values->record_id)->where('field_id', $Assetsfield_values->field_id)->update($data);
                    }
                }
            }
            return redirect()->back();
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }

    //dropzone through add files 
    public function fileUpload($id, Request $request)
    {
        
        $objUser            = Auth::user();
        $Company_ID = $objUser->Company_ID();
        $currentlocation = User::userCurrentLocation();

        $request->validate(['file' => 'required|mimes:png,jpeg,jpg,pdf,doc,txt,application/octet-stream,audio/mpeg,mpga,mp3,wav|max:20480']);
        $file_name = $request->file->getClientOriginalName();
        
        $file_path = $request->lead_id . "_" . md5(time()) . "_" . $request->file->getClientOriginalName();
        $request->file->storeAs('documents_files', $file_path);

        $file = AssetsFieldValues::create(
            [

                'record_id' => $id,
                'field_id' => 15,
                'value' => $file_path,
                'location_id' => $currentlocation,
                'created_by' => $objUser->id,
                'company_id' => $objUser->Company_ID(),
            ]
        );
        $return               = [];
        $return['is_success'] = true;
        $return['download']   = route(
            'assets.file.download',
            [$file->id]
        );

        $return['delete']     = route(
            'assets.file.delete',
            [$file->id]
        );

        return response()->json($return);
    }


    public function fileDownload($id)
    {

        $file = AssetsFieldValues::find($id);
        if ($file) {
            $file_path = storage_path('documents_files/' . $file->value);
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

        $file = AssetsFieldValues::find($id);
        if ($file) {
            $path = storage_path('documents_files/' . $file->value);
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


    public function destroy($id)
    {

        if (\Auth::user()->can('delete assets')) {
            $Assets = Assets::where(['id' => $id])->delete();
            if ($Assets) {
                $AssetsFieldValues = AssetsFieldValues::where(['record_id' => $id])->delete();
                return redirect()->back()->with('success', __('Assets deleted successfully.'));
            } else {
                return redirect()->back()->with('error', __('Something went wrong.'));
            }
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function associateAssetsView($module, $id)
    {
        $objUser            = Auth::user();
        $Company_ID = $objUser->Company_ID();
        $currentlocation = User::userCurrentLocation();

        //vendros detail page in assets
        if ($module == 'vendors') {
            if (Auth::user()->can('associate parts')) {
                if ($currentlocation == 0) {
                    return redirect()->back()->with('error', __('Current location is not available.'));
                }
                $vendor_parts = Vendor::find($id);
                $assets = Assets::where(['company_id' => $Company_ID, 'location_id' => $currentlocation, 'is_active' => 1])->whereNotIn('id', explode(',', $vendor_parts->assets_id))->get()->pluck('name', 'id');
                $vendor_id = $id;
                return view('assets.associate', compact('assets', 'vendor_id', 'id', 'module'));
            } else {
                return redirect()->back()->with('error', __('Permission Denied.'));
            }
        }
        //parts detail page in assets
        elseif ($module == 'parts_assets') {
            if (Auth::user()->can('associate assets')) {
                if ($currentlocation == 0) {
                    return redirect()->back()->with('error', __('Current location is not available.'));
                }
                $parts = Parts::find($id);
                $assets = Assets::where(['company_id' => $Company_ID, 'location_id' => $currentlocation, 'is_active' => 1])->whereNotIn('id', explode(',', $parts->assets_id))->get()->pluck('name', 'id');
                $parts_id = $id;

                return view('assets.associate', compact('assets', 'parts_id', 'id', 'module'));
            } else {
                return redirect()->back()->with('error', __('Permission Denied.'));
            }
        }
    }


    public function associateAssets(Request $request, $module, $id)
    {
        $objUser            = Auth::user();
        $Company_ID = $objUser->Company_ID();
        $currentlocation = User::userCurrentLocation();
        //vendros deatil page in assets
        if ($module == 'vendors') {

            $Vendor = Vendor::where(['id' => $id, 'company_id' => $Company_ID, 'is_active' => 1])->first();
            if (!is_null($Vendor)) {

                $vendor_part_id = empty($Vendor->assets_id) ? implode(',', $request->associate_parts)  : $Vendor->assets_id . ',' . implode(',', $request->associate_parts);
                $Vendor->assets_id = $vendor_part_id;
                $Vendor->save();

                return redirect()->back()->with(['success' => __('Assets associate to vendor successfully.'), 'tab-status' => 'assets']);
            } else {

                return redirect()->back()->with(['error' => __('Assets is not available.'), 'tab-status' => 'assets']);
            }
        }
        //parts detail page in asset
        elseif ($module == 'parts_assets') {

            $Parts = Parts::where(['id' => $id, 'company_id' => $Company_ID, 'is_active' => 1])->first();
            if (!is_null($Parts)) {

                $parts_asset_id = empty($Parts->assets_id) ? implode(",", $request->associate_parts) : $Parts->assets_id . ',' . implode(',', $request->associate_parts);
                $Parts->assets_id = $parts_asset_id;
                $Parts->save();

                return redirect()->back()->with(['success' => __('Asset associate to parts successfully.'), 'tab-status' => 'asset']);
            } else {

                return redirect()->back()->with(['error' => __('Assets is not available.'), 'tab-status' => 'asset']);
            }
        } else {
            return redirect()->back()->with('error', __('Something went to wrong.'));
        }
    }


    public function removeAssociateAssets(Request $request, $module, $id)
    {
        //vendors detail page in asset
        if ($module == "vendors") {

            $Vendor = Vendor::where(['id' => $request->vendor_id, 'is_active' => 1])->first();
            $vendor_part_id = explode(',', $Vendor->assets_id);
            unset($vendor_part_id[array_search($id, $vendor_part_id)]);
            $vendor_part_id=array_filter($vendor_part_id);
            $Vendor->assets_id = implode(',', $vendor_part_id);
            $Vendor->save();

            return redirect()->back()->with(['success' => __('Assocoated assets successfully deleted.'), 'tab-status' => 'assets']);
        }
        //parts detail page in asset
        elseif ($module == "parts") {

            $Parts = Parts::where(['id' => $request->parts_id, 'is_active' => 1])->first();
            $asset_part_id = explode(',', $Parts->assets_id);
            unset($asset_part_id[array_search($id, $asset_part_id)]);
            $asset_part_id = array_filter($asset_part_id);
            $Parts->assets_id = implode(',', $asset_part_id);
            $Parts->save();

            return redirect()->back()->with(['success' => __('Associated assets successfully deleted.'), 'tab-status' => 'asset']);
        }
    }
    //asset detail page in report charts 
    public function getChartData($arrParam)
    {
        $arrDuration = [];
        $asset_id = $arrParam['asset_id'];
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
            $data = AssetsLogTime::select(\DB::raw('sum(hours) as total_hours'))->where('assets_id', $asset_id)->whereMonth('created_at', date('m', strtotime($label)))->whereYear('created_at', $year)->first();

            if ($data->total_hours != null) {
                $final_data = $data->total_hours;
            } else {
                $final_data = 0;
            }
            $arrTask['label'][] = $label;
            $arrTask['data'][]  = $final_data;
        }
        return $arrTask;
    }
}
