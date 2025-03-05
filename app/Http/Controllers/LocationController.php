<?php

namespace App\Http\Controllers;

use App\Mail\EmailTest;
use App\Models\location;
use App\Models\User;
use App\Models\Utility;
use App\Models\Assets;
use App\Models\LocationSetting;
use App\Models\Plan;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;

class LocationController extends Controller
{

    public function index()
    {
        if (Auth::user()->can('manage location')) {

            $objUser            = Auth::user();
            $Company_ID = $objUser->Company_ID();
            if (Auth::user()->user_type == 'company' || Auth::user()->user_type == 'employee') {
                $locations = location::where(['company_id' => $Company_ID])->get();

                return view('location.index', compact('locations'));
            } else {
                return redirect()->back()->with('error', __('Permission Denied.'));
            }
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function create()
    {

        return view('location.create');
    }


    public function store(Request $request)
    {

        if (Auth::user()->can('create location')) {
            $objUser            = Auth::user();
            $plan             = Plan::find($objUser->plan);
            if ($plan) {
                $totalWS = $objUser->countLocation();
                if ($totalWS < $plan->max_locations || $plan->max_locations == -1) {
                    if (Auth::user()->user_type == 'company' || Auth::user()->user_type == 'employee') {
                        $validator = Validator::make($request->all(), [
                            'name' => 'required',
                            'address' => 'required',
                        ]);

                        if ($validator->fails()) {
                            $messages = $validator->getMessageBag();

                            return redirect()->back()->with('error', $messages->first());
                        }



                        $location = location::create(
                            [
                                'created_by' => $objUser->id,
                                'name' => $request->name,
                                'address' => $request->address,
                                'company_id' => $objUser->Company_ID(),
                            ]
                        );

                        return redirect()->back()->with('success', __('Location Created Successfully!'));
                    } else {
                        return redirect()->back()->with('error', __('Permission Denied.'));
                    }
                } else {
                    return redirect()->back()->with('error', __('Your Location limit is over, Please upgrade plan.'));
                }
            } else {
                return redirect()->back()->with('error', __('Default plan is deleted.'));
            }
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function show(location $location)
    {
    }


    public function edit(location $location)
    {

        return view('location.edit', compact('location'));
    }


    public function update(Request $request, location $location)
    {

        if (Auth::user()->can('edit location')) {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'address' => 'required',
            ]);

            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $location->name = $request->name;
            $location->address = $request->address;
            $location->save();

            return redirect()->back()->with('success', __('Location Updated Successfully!'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function destroy(location $location)
    {

        if (Auth::user()->can('delete location')) {
            $location->delete();
            return redirect()->back()->with('success', __('Location Deleted Successfully!'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function work_request_portal($id)
    {

        $location_id = Crypt::decrypt($id);
        $location = location::find($location_id);

        $assets = Assets::where(['company_id' => $location->company_id, 'location_id' => $location_id, 'is_active' => 1])->get()->pluck('name', 'id');

        return view('work_request.portal', compact('id', 'assets'));
    }


    public function QRCode($id)
    {
        return view('work_request.QRCodelink', compact('id'));
    }


    public function changeCurrentLocation($locationID)
    {

        $objLocation = location::find($locationID);
        if ($objLocation->is_active) {
            $current_location           = Utility::getLocationBySlug($objLocation->slug);
            $objUser                    = Auth::user();
            $objUser->current_location = $locationID;
            $objUser->save();

            return redirect()->route('home')->with('success', __('Location Change Successfully!'));
        } else {
            return redirect()->back()->with('error', __('Location is locked'));
        }
    }

    //company setting
    public function settings()
    {
        $objUser          = Auth::user();
        $currentlocation = User::userCurrentLocationDetail();
        $location = LocationSetting::where('location_id', $currentlocation->id)->pluck('value', 'name')->toArray();
        $email_data = LocationSetting::where('location_id', NULL)->pluck('value', 'name')->toArray();

        if ($currentlocation->created_by == $objUser->id) {
            return view('users.setting', compact('location', 'email_data'));
        } else {
            return redirect()->route('home')->with('error', __("You can not access location settings!"));
        }
    }
    //company setting
    public function settingsStore(Request $request)
    {

        $objUser          = Auth::user();
        $currentlocation = User::userCurrentLocationDetail();

        if ($currentlocation->created_by == $objUser->id) {

            $validate      = [];
            $validator = Validator::make(
                $request->all(),
                $validate
            );

            if ($validator->fails()) {
                return redirect()->back()->with('error', $validator->errors()->first());
            }
            $post = $request->all();
            unset($post['_token'], $post['logo'],$post['white_logo'], $post['favicon']);
            foreach ($post as $key => $name) {
                $favicon = LocationSetting::updateOrCreate(
                    ['location_id' => $currentlocation->id, 'name' => $key],
                    ['location_id' => $currentlocation->id, 'name' => $key, 'value' => $name]
                );

                if ($request->logo) {

                    Artisan::call('cache:clear');
                    $request->validate(['logo' => 'required|mimes:jpeg,jpg,png,gif,svg|max:204800']);
                    $logoName = 'logo_' . $currentlocation->id . '.png';
                    $request->logo->storeAs('logo', $logoName);

                    $logo = LocationSetting::updateOrCreate(
                        ['location_id' => $currentlocation->id, 'name' => 'logo'],
                        ['location_id' => $currentlocation->id, 'name' => 'logo', 'value' => $logoName]
                    );
                }

                if($request->white_logo)
            {
                $request->validate(['white_logo' => 'required|image|mimes:jpeg,jpg,png|max:204800']);
                $request->white_logo->storeAs('logo', 'logo-light.png');
            }


                // if ($request->white_logo) {

                //     Artisan::call('cache:clear');
                //     $request->validate(['white_logo' => 'required|mimes:jpeg,jpg,png,gif,svg|max:204800']);
                //     $logoName = 'white_logo_' . $currentlocation->id . '.png';
                //     // dd($logoName);
                //     $request->logo->storeAs('logo', $logoName);

                //     $white_logo = LocationSetting::updateOrCreate(
                //         ['location_id' => $currentlocation->id, 'name' => 'white_logo'],
                //         ['location_id' => $currentlocation->id, 'name' => 'white_logo', 'value' => $logoName]
                //     );
                //     dd($white_logo);
                // }

                if ($request->favicon) {

                    Artisan::call('cache:clear');
                    $request->validate(['favicon' => 'required|mimes:jpeg,jpg,png,gif,svg|max:204800']);
                    $logoName = 'favicon_' . $currentlocation->id . '.png';
                    $request->favicon->storeAs('logo', $logoName);

                    $favicon = LocationSetting::updateOrCreate(
                        ['location_id' => $currentlocation->id, 'name' => 'favicon'],
                        ['location_id' => $currentlocation->id, 'name' => 'favicon', 'value' => $logoName]
                    );
                }
            }
            return redirect()->back()->with('success', __('Settings Save Successfully.!'));
        } else {
            return redirect()->route('home')->with('error', __("You can't access Location settings!"));
        }
    }

    public function emailSettingStore(Request $request)
    {
        $user = Auth::user();
        if ($user->user_type == 'company') {
            $post = $request->all();


            unset($post['_token']);
            foreach ($post as $key => $data) {
                $company_email_setting = LocationSetting::updateOrCreate(
                    ['name' => $key],
                    ['name' => $key, 'value' => $data]
                );
            }
            return redirect()->back()->with('success', __('Email Settings Save Successfully.!'));

        } else {
            return redirect()->back()->with('error', __('Something is wrong'));
        }
    }
    public function testmail(Request $request)
    {

        $user = Auth::user();

        if ($user->user_type == 'company') {
            $data                      = [];
            $data['mail_driver']       = $request->mail_driver;
            $data['mail_host']         = $request->mail_host;
            $data['mail_port']         = $request->mail_port;
            $data['mail_username']     = $request->mail_username;
            $data['mail_password']     = $request->mail_password;
            $data['mail_encryption']   = $request->mail_encryption;
            $data['mail_from_address'] = $request->mail_from_address;
            $data['mail_from_name']    = $request->mail_from_name;

            return view('users.test_email', compact('data'));
        } else {
            return response()->json(['error' => __('Permission Denied.')], 401);
        }
    }
    public function testmailstore(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'email' => 'required|email',
            'mail_driver' => 'required',
            'mail_host' => 'required',
            'mail_port' => 'required',
            'mail_username' => 'required',
            'mail_password' => 'required',
            'mail_from_address' => 'required',
            'mail_from_name' => 'required',
        ]);
        if ($validator->fails()) {
            $messages = $validator->getMessageBag();

            return redirect()->back()->with('error', $messages->first());
        }

        try {
            config([
                'mail.driver' => $request->mail_driver,
                'mail.host' => $request->mail_host,
                'mail.port' => $request->mail_port,
                'mail.encryption' => $request->mail_encryption,
                'mail.username' => $request->mail_username,
                'mail.password' => $request->mail_password,
                'mail.from.address' => $request->mail_from_address,
                'mail.from.name' => $request->mail_from_name,
            ]);
            Mail::to($request->email)->send(new EmailTest());
        } catch (\Exception $e) {
            return response()->json([
                'is_success' => false,
                'message' => $e->getMessage(),
            ]);
        }

        return response()->json([
            'is_success' => true,
            'message' => __('Email send Successfully'),
        ]);
    }
    public function changeLangAdmin($lang)
    {

        if (Auth::user()->user_type == 'super admin' || Auth::user()->user_type == 'company' || Auth::user()->user_type == "employee" && app('App\Http\Controllers\SettingsController')->setEnvironmentValue(['DEFAULT_ADMIN_LANG' => $lang])) {

            $user = User::where('id', Auth::user()->id)->first();
            $user->lang = $lang;
            $user->save();
            return redirect()->back();
        } else {
            return redirect()->back()->with('error', __('Something is wrong'));
        }
    }
}
