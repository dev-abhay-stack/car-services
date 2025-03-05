<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Utility;
use File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Mail\CommonEmailTemplate;
use App\Models\location;
use App\Models\LocationSetting;
use Illuminate\Support\Facades\Mail;
use App\Models\Plan;
use App\Models\Order;

class UserController extends Controller
{

    public function index()
    {

        $user = Auth::user();

        $currentlocation = User::userCurrentLocation();

        if (Auth::user()->can('manage user')) {
            if (Auth::user()->user_type == 'super admin') {
                $users = User::where(['user_type' => 'company', 'created_by' => $user->id])->get();
            } elseif (Auth::user()->user_type == 'company') {
                $users = User::where('created_by', '=', $user->creatorId())->whereNotIn('user_type', ['company', 'client'])->whereRaw("find_in_set($currentlocation,location_id)")->get();
            } else {
                return redirect()->back()->with('error', __('Permission Denied.'));
            }
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }

        return view('users.index', compact('users'));
    }


    public function create()
    {
        $user  = Auth::user();
        $roles = Role::where('created_by', '=', $user->creatorId())->get()->pluck('name', 'id');
        
        return view('users.create', compact('roles'));
    }


    public function store(Request $request)
    {

        if (Auth::user()->can('create user')) {
            $resp = '';
            $objUser = Auth::user();
            $currentlocation = User::userCurrentLocation();
            $plan             = Plan::find($objUser->plan);



            if ($currentlocation == 0 && Auth::user()->user_type != 'super admin') {
                return redirect()->back()->with('error', __('Current location is not available.'));
            }

            if (Auth::user()->user_type == 'super admin') {
                $validator = \Validator::make(
                    $request->all(),
                    [
                        'name' => 'required|max:120',
                        'email' => 'required|email|unique:users',
                        'password' => 'required|min:6',
                    ]
                );

                if ($validator->fails()) {
                    $messages = $validator->getMessageBag();

                    return redirect()->route('users.index')->with('error', $messages->first());
                }


                $user               = new User();
                $user['name']       = $request->name;
                $user['last_name']       = $request->last_name;
                $user['email']      = $request->email;
                $user['password']   = Hash::make($request->password);
                $user['user_type']       = 'company';
                $user['created_by'] = Auth::user()->creatorId();
                $user->save();
                $assignPlan = $user->assignPlan(1);
                if (!$assignPlan['is_success']) {
                    return redirect()->back()->with('error', __($assignPlan['error']));
                }


                $location = new location();
                $location->created_by = $user->id;
                $location->name = "test location";
                $location->address = "test address";
                $location->company_id = $user->id;
                $location->slug = $location->name;

                $location->save();

                $user_location = User::find($user->id);
                $user_location->location_id = $location->id;
                $user_location->current_location = $location->id;
                $user_location->save();

                $role_r = Role::findByName('company');
                $mailTo = $request->email;
                $user_password   = $request->password;
                $resp = [];
                try {
                    config([
                        'mail.driver' => env('MAIL_DRIVER'),
                        'mail.host' => env('MAIL_HOST'),
                        'mail.port' => env('MAIL_PORT'),
                        'mail.encryption' => env('MAIL_ENCRYPTION'),
                        'mail.username' => env('MAIL_USERNAME'),
                        'mail.password' => env('MAIL_PASSWORD'),
                        'mail.from.address' => env('MAIL_FROM_ADDRESS'),
                        'mail.from.name' => env('MAIL_FROM_NAME'),
                    ]);
                    Mail::to($mailTo)->send(new CommonEmailTemplate($mailTo, $user_password));
                    $resp['is_success'] = true;
                } catch (\Exception $e) {
                    $resp['is_success'] = false;
                    $resp['error'] = __('E-Mail has been not sent due to SMTP configuration');
                }
                $user->assignRole($role_r);
            } else {

                if ($plan) {
                    $totalWS = $objUser->countLocationUser($currentlocation);
                    if ($totalWS < $plan->max_users || $plan->max_users == -1) {
                        $validator = \Validator::make(
                            $request->all(),
                            [
                                'name' => 'required|max:120',
                                'email' => 'required|email|unique:users',
                                'password' => 'required|min:6',
                                'role' => 'required',
                                'phone_no' => 'required',
                            ]
                        );

                        if ($validator->fails()) {
                            $messages = $validator->getMessageBag();

                            return redirect()->back()->with('error', $messages->first());
                        }

                        $objUser    = Auth::user();
                        $password   = $request->password;
                        $user_password   = $request->password;

                        $role_r                = Role::findById($request->role);
                        $request['password']   = Hash::make($request->password);
                        $request['user_type']       = 'employee';
                        $user['last_name']       = $request->last_name;
                        $request['phone_no'] = $request->phone_no;
                        // $request['lang']       = Utility::getValByName('default_language');
                        $request['lang']       = 'en';
                        $request['created_by'] = Auth::user()->creatorId();
                        $request['company_id'] = Auth::user()->Company_ID();
                        $request['location_id'] = $currentlocation;

                        $user                  = User::create($request->all());

                        $mailTo = $request->email;

                        $resp = [];

                        $emaildata = LocationSetting::where('location_id', NULL)->pluck('value', 'name')->toArray();

                        try {
                            config([
                                'mail.driver' => $emaildata['mail_driver'],
                                'mail.host' => $emaildata['mail_host'],
                                'mail.port' => $emaildata['mail_port'],
                                'mail.encryption' => $emaildata['mail_encryption'],
                                'mail.username' => $emaildata['mail_username'],
                                'mail.password' => $emaildata['mail_password'],
                                'mail.from.address' => $emaildata['mail_from_address'],
                                'mail.from.name' => $emaildata['mail_from_name'],
                            ]);
                            Mail::to($mailTo)->send(new CommonEmailTemplate($mailTo, $user_password));
                            $resp['is_success'] = true;
                        } catch (\Exception $e) {
                            $resp['is_success'] = false;
                            $resp['error'] = __('E-Mail has been not sent due to SMTP configuration');
                        }


                        $user->assignRole($role_r);
                    } else {
                        return redirect()->back()->with('error', __('Your User limit is over, Please upgrade plan.'));
                    }
                } else {
                    return redirect()->back()->with('error', __('Default plan is deleted.'));
                }
            }

            return redirect()->back()->with(
                'success',
                __('User successfully added.') . ((!empty($resp) && $resp['is_success'] == false && !empty($resp['error'])) ? '<br> <span class="text-danger">' . $resp['error'] . '</span>' : '')
            );
        } else {
            return redirect()->back();
        }
    }


    public function edit($id)
    {

        $roles = Role::where('created_by', '=', Auth::user()->Company_ID())->get()->pluck('name', 'id');
        $users = User::where('id', $id)->where('created_by', Auth::user()->Company_ID())->get();
        return view('users.edit', compact('users', 'roles'));
    }


    public function update(Request $request, $id)
    {

        if (Auth::user()->can('edit user')) {
            $resp = '';

            $currentlocation = User::userCurrentLocation();

            if ($currentlocation == 0) {
                return redirect()->back()->with('error', __('Current location is not available.'));
            }

            if (Auth::user()->user_type == 'super admin') {
                $validator = \Validator::make(
                    $request->all(),
                    [
                        'name' => 'required|max:120',
                    ]
                );

                if ($validator->fails()) {
                    $messages = $validator->getMessageBag();

                    return redirect()->route('users.index')->with('error', $messages->first());
                }

                $user['name']       = $request->name;
                $user['last_name']       = $request->last_name;
                $user['phone_no'] = $request->phone_no;

                User::where('id', $id)->update($user);
            } else {

                $validator = \Validator::make(
                    $request->all(),
                    [
                        'name' => 'required|max:120',
                        'phone_no' => 'required',
                    ]
                );

                if ($validator->fails()) {
                    $messages = $validator->getMessageBag();
                    return redirect()->back()->with('error', $messages->first());
                }

                $user['name']       = $request->name;
                $user['last_name']       = $request->last_name;
                $user['phone_no'] = $request->phone_no;
                $user             = User::where('id', $id)->update($user);

                $resp = [];
            }

            return redirect()->back()->with(
                'success',
                __('User Successfully Update.') . ((!empty($resp) && $resp['is_success'] == false && !empty($resp['error'])) ? '<br> <span class="text-danger">' . $resp['error'] . '</span>' : '')
            );
        } else {
            return redirect()->back();
        }
    }


    public function destroy($id)
    {

        if (\Auth::user()->can('delete user')) {
            $user = User::find($id);
            if ($user) {
                if (\Auth::user()->type == 'super admin') {
                    $user->delete();
                } else {
                    $user->delete();
                }
                return redirect()->route('users.index')->with('success', __('User successfully deleted .'));
            } else {
                return redirect()->back()->with('error', __('Something is wrong.'));
            }
        } else {
            return redirect()->back();
        }
    }

    public function changePlan($user_id)
    {
        $user = Auth::user();
        if ($user->user_type == 'super admin') {
            $plans = Plan::get();
            $user  = User::find($user_id);
            return view('users.change_plan', compact('plans', 'user'));
        } else {
            return redirect()->back()->with('error', __('Some Thing Is Wrong!'));
        }
    }

    public function manuallyActivatePlan(Request $request, $user_id, $plan_id, $duration)
    {
        $user       = User::find($user_id);
        $plan       = Plan::find($plan_id);
        $assignPlan = $user->assignPlan($plan->id, $duration);
        if ($assignPlan['is_success'] == true && !empty($plan)) {
            $price      = $plan->{$duration . '_price'};
            if (!empty($user->payment_subscription_id) && $user->payment_subscription_id != '') {
                try {
                    $user->cancel_subscription($user_id);
                } catch (\Exception $exception) {
                    \Log::debug($exception->getMessage());
                }
            }
            $orderID = strtoupper(str_replace('.', '', uniqid('', true)));
            Order::create([
                'order_id' => $orderID,
                'name' => null,
                'email' => null,
                'card_number' => null,
                'card_exp_month' => null,
                'card_exp_year' => null,
                'plan_name' => $plan->name,
                'plan_id' => $plan->id,
                'price' => $price,
                'plan_type' => $duration,
                'price_currency' => !empty(env('CURRENCY')) ? env('CURRENCY') : 'USD',
                'txn_id' => '',
                'payment_type' => __('Manually Upgrade By Super Admin'),
                'payment_status' => 'succeeded',
                'receipt' => null,
                'user_id' => $user->id,
            ]);
            return redirect()->back()->with('success', __('Plan successfully upgraded.'));
        } else {
            return redirect()->back()->with('error', __('Plan fail to upgrade.'));
        }
    }

    public function account(Request $request)
    {
        $user             = Auth::user();
        $currentlocation = User::userCurrentLocation();

        return view('users.account', compact('currentlocation', 'user'));
    }
    public function accountupdate(Request $request, $id = null)
    {

        $currentlocation = User::userCurrentLocation();
        if ($id) {
            $objUser = User::find($id);
        } else {
            $objUser = Auth::user();
        }
        $validation         = [];
        $validation['name'] = 'required';
        $validation['email'] = 'required|email|max:100|unique:users,email,' . $objUser->id . ',id';

        if ($request->has('avatar')) {
            $validation['avatar'] = 'required|mimes:jpeg,jpg,png,gif,svg|max:204800';
        }

        $validator = \Validator::make($request->all(), $validation);
        if ($validator->fails()) {
            $messages = $validator->getMessageBag();
            return redirect()->back()->with('error', $messages->first());
        }

        $objUser->name = $request->name;
        $objUser->email = $request->email;

        if ($request->has('avatar')) {
            if (asset(\Storage::exists('avatars/' . $objUser->avatar))) {
                asset(\Storage::delete('avatars/' . $objUser->avatar));
            }

            $logoName = uniqid() . '.png';
            $request->avatar->storeAs('avatars', $logoName);
            $objUser->avatar = $logoName;
        }

        $objUser->save();
        return redirect()->back()->with('success', __('User Updated Successfully!'));
    }
    public function deleteAvatar()
    {
        $objUser         = Auth::user();
        if (asset(\Storage::exists('avatars/' . $objUser->avatar))) {
            asset(\Storage::delete('avatars/' . $objUser->avatar));
        }
        $objUser->avatar = '';
        $objUser->save();

        return redirect()->back()->with('success', 'Avatar deleted successfully');
    }
    public function updatePassword(Request $request)
    {
        if (Auth::Check()) {
            $request->validate(
                [
                    'old_password' => 'required',
                    'password' => 'required|same:password',
                    'password_confirmation' => 'required|same:password',
                ]
            );
            
            
            $objUser          = Auth::user();
            $request_data     = $request->All();
            $current_password = $objUser->password;
            

            if (Hash::check($request_data['old_password'], $current_password)) {
                $objUser->password = Hash::make($request_data['password']);;
                $objUser->save();

                return redirect()->back()->with('success', __('Password Updated Successfully!'));
            } 
            elseif($request->password != $request->password_confirmation)
            {
                return redirect()->back()->with('error',__('Confrom Password Does not Match with New Password'));
            }
            elseif($objUser->password != $request->old_password)
            {
                return redirect()->back()->with('error',__('Please Enter your right old password'));
            }
            else {
                return redirect()->back()->with('error', __('Please Enter Correct Current Password!'));
            }
        } else {
            return redirect()->back()->with('error', __('Some Thing Is Wrong!'));
        }
    }
}
