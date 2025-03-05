<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\location;
use App\Models\Order;
use App\Models\Plan;

class CheckPlan
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(\Auth::check())
        {   
            $user=Auth::user();
            if($user->user_type != 'super admin')
            {
                $location=location::find($user->current_location);
                if($location->created_by==$user->id)
                {
                    if($user->is_trial_done < 2)
                    {       
                        if($user->is_trial_done == 1 && $user->plan_expire_date < date('Y-m-d'))
                        {
                            $user->is_trial_done = 2;
                            $user->save();
                        }
                    }
                    if((empty($user->plan_expire_date) || $user->plan_expire_date < date('Y-m-d')) && $user->plan != 1)
                    {
                        $plan = Plan::find(1);
                        $user->assignPlan(1);
                        if(!empty($plan))
                        {
                            $orderID = strtoupper(str_replace('.', '', uniqid('', true)));
                            Order::create(
                                [
                                    'order_id' => $orderID,
                                    'name' => null,
                                    'email' => null,
                                    'card_number' => null,
                                    'card_exp_month' => null,
                                    'card_exp_year' => null,
                                    'plan_name' => $plan->name,
                                    'plan_id' => $plan->id,
                                    'price' => 0,
                                    'price_currency' => !empty(env('CURRENCY')) ? env('CURRENCY') : 'USD',
                                    'txn_id' => '',
                                    'payment_type' => __('Zero Price'),
                                    'payment_status' => 'succeeded',
                                    'receipt' => null,
                                    'user_id' => $user->id,
                                ]
                            );
                        }
                    }

                }
            }
        }
        return $next($request);
    }
}
