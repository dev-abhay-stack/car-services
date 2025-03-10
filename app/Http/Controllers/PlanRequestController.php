<?php

namespace App\Http\Controllers;

use App\Models\PlanRequest;
use Illuminate\Http\Request;
use App\Models\Plan;
use App\Models\Utility;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class PlanRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
    {

            $plan_requests = PlanRequest::all();

            
            return view('plan_request.index', compact('plan_requests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function userRequest($plan_id)
    {
        $objUser = Auth::user();

        if($objUser->requested_plan == 0)
        {
            $planID = \Illuminate\Support\Facades\Crypt::decrypt($plan_id);
            if(!empty($planID))
            {
                PlanRequest::create([
                                        'user_id' => $objUser->id,
                                        'plan_id' => $planID,

                                    ]);

                // Update User Table
               

                $data                 = User::find($objUser->id);
                $data->requested_plan = $planID;
                $data->update();

                return redirect()->back()->with('success', __('Request Send Successfully.'));
            }
            else
            {
                return redirect()->back()->with('error', __('Something went wrong.'));
            }
        }
        else
        {
            return redirect()->back()->with('error', __('You already send request to another plan.'));
        }
    }

   public function acceptRequest($id, $response)
    {
        if(Auth::user()->user_type == 'super admin')
        {
            $plan_request = PlanRequest::find($id);
            if(!empty($plan_request))
            {
                $user = User::find($plan_request->user_id);
               
                if($response == 1)
                { 
                    $user->requested_plan ='0';
                    $user->plan           = $plan_request->plan_id;
                    $user->save();

                    $plan       = Plan::find($plan_request->plan_id);
                    $assignPlan = $user->assignPlan($plan_request->plan_id, $plan_request->duration);
                    $price      = $plan->{$plan_request->duration . '_price'};

                    if($assignPlan['is_success'] == true && !empty($plan))
                    {
                        if(!empty($user->payment_subscription_id) && $user->payment_subscription_id != '')
                        {
                            try
                            {
                                $user->cancel_subscription($user->id);
                            }
                            catch(\Exception $exception)
                            {
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
                                          'price_currency' => !empty(env('CURRENCY_CODE')) ? env('CURRENCY_CODE') : 'USD',
                                          'txn_id' => '',
                                          'payment_type' => __('Manually Upgrade By Super Admin'),
                                          'payment_status' => 'succeeded',
                                          'receipt' => null,
                                          'user_id' => $user->id,
                                      ]);

                        $plan_request->delete();
                        

                        return redirect()->back()->with('success', __('Plan successfully upgraded.'));
                    }
                    else
                    {
                        return redirect()->back()->with('error', __('Plan fail to upgrade.'));
                    }
                }
                else
                {
                    $user->update(['requested_plan' => '0']);
                    $plan_request->delete();

                    return redirect()->back()->with('success', __('Request Rejected Successfully.'));
                }
            }
            else
            {
                return redirect()->back()->with('error', __('Something went wrong.'));
            }
        }
        else
        {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    /*
     * @id = User ID
    */
    public function cancelRequest($id)
    {

        $user = User::find($id);
        $user['requested_plan'] = 0;
        $user->update();
        PlanRequest::where('user_id', $id)->delete();

         


        return redirect()->back()->with('success', __('Request Canceled Successfully.'));
    }

}
