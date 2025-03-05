<?php


namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Order;
use App\Models\Plan;
use App\Models\User;
use App\Models\UserCoupon;
use App\Models\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Http\RedirectResponse;

class StripePaymentController
{
    public $currancy;
    public $currancy_symbol;

    public $stripe_secret;
    public $stripe_key;
    public $stripe_webhook_secret;



    public function index()
    {
        $objUser = \Auth::user();
        if($objUser->user_type == 'super admin')
        {

$orders=Order::select('orders.*','users.id','user_coupons.user','user_coupons.coupon')->join('users','users.id','=','orders.user_id')->join('user_coupons','user_coupons.user','=','users.id')->get();

        }
        else
        {
            $orders = Order::select(
                [
                    'orders.*',
                    'users.name as user_name',
                ]
            )->join('users', 'orders.user_id', '=', 'users.id')->orderBy('orders.created_at', 'DESC')->where('users.id', '=', $objUser->id)->get();
        }

        return view('order.index', compact('orders'));
    }

    public function stripePost(Request $request)
    {
        $this->planpaymentSetting();

        $objUser = \Auth::user();
        $planID  = \Illuminate\Support\Facades\Crypt::decrypt($request->plan_id);
        $plan    = Plan::find($planID);

        if($plan)
        {
            try
            {

                $price = (float)$plan->{$request->stripe_payment_frequency . '_price'};

                if(!empty($request->coupon))
                {
                    $coupons = Coupon::where('code', strtoupper($request->coupon))->where('is_active', '1')->first();
                    if(!empty($coupons))
                    {
                        $usedCoupun     = $coupons->used_coupon();
                        $discount_value = ($plan->{$request->stripe_payment_frequency . '_price'} / 100) * $coupons->discount;
                        $price          = $plan->{$request->stripe_payment_frequency . '_price'} - $discount_value;

                        if($coupons->limit == $usedCoupun)
                        {
                            return redirect()->back()->with('error', __('This coupon code has expired.'));
                        }
                    }
                    else
                    {
                        return redirect()->back()->with('error', __('This coupon code is invalid or has expired.'));
                    }
                }

                $orderID = strtoupper(str_replace('.', '', uniqid('', true)));

                if($price > 0.0)
                {
                    try
                    {
                        $coupons = Coupon::where('code', strtoupper($request->coupon))->where('is_active', '1')->first();
                        $authuser     = Auth::user();
                        $payment_plan = $payment_frequency = $request->payment_frequency;
                        $payment_type = $request->payment_type;

                        /* Payment details */
                        $code = '';




                        if(isset($request->coupon) && !empty($request->coupon) && $plan->discounted_price)
                        {
                            $price = $plan->discounted_price;
                            $code  = $request->coupon;
                        }

                        $product = $plan->name;

                        /* Final price */
                        $stripe_formatted_price = in_array(
                            $this->currancy, [
                                               'MGA',
                                               'BIF',
                                               'CLP',
                                               'PYG',
                                               'DJF',
                                               'RWF',
                                               'GNF',
                                               'UGX',
                                               'JPY',
                                               'VND',
                                               'VUV',
                                               'XAF',
                                               'KMF',
                                               'KRW',
                                               'XOF',
                                               'XPF',
                                           ]
                        ) ? number_format($price, 2, '.', '') : number_format($price, 2, '.', '') * 100;

                        $return_url_parameters = function ($return_type){
                            return '&return_type=' . $return_type . '&payment_processor=stripe';
                        };

                        /* Initiate Stripe */
                        \Stripe\Stripe::setApiKey($this->stripe_secret);



                        $stripe_session = \Stripe\Checkout\Session::create(
                            [
                                'payment_method_types' => ['card'],
                                'line_items' => [
                                    [
                                        'name' => $product,
                                        'description' => $payment_plan,
                                        'amount' => $stripe_formatted_price,
                                        'currency' => $this->currancy,
                                        'quantity' => 1,
                                    ],
                                ],
                                'metadata' => [
                                    'user_id' => $authuser->id,
                                    'package_id' => $plan->id,
                                    'payment_frequency' => $payment_frequency,
                                    'code' => $code,
                                ],
                                'success_url' => route(
                                    'stripe.payment.status', [
                                                               'plan_id' => $plan->id,
                                                               'coupon_id' => $coupons->id,
                                                               'frequency' => $request->stripe_payment_frequency,
                                                               'currency' => $this->currancy,
                                                               'amount' => $price,
                                                               $return_url_parameters('success'),
                                                           ]
                                ),
                                'cancel_url' => route(
                                    'stripe.payment.status', [
                                                               'plan_id' => $plan->id,
                                                               'coupon_id' => $coupons->id,
                                                               'currency' => $this->currancy,
                                                               'amount' => $price,
                                                               'frequency' => $request->stripe_payment_frequency,
                                                               $return_url_parameters('cancel'),
                                                           ]
                                ),
                            ]
                        );

                        $stripe_session = $stripe_session ?? false;


                        try{
                            return new RedirectResponse($stripe_session->url);
                        }catch(\Exception $e)
                        {
                            return redirect()->route('plans.index')->with('error', __('Transaction has been failed!'));
                        }
                    }
                    catch(\Exception $e)
                    {
                        \Log::debug($e->getMessage());
                    }
                }else{

                    Order::create(
                        [
                            'order_id' => $orderID,
                            'name' => $request->name,
                            'card_number' => '',
                            'card_exp_month' => '',
                            'card_exp_year' => '',
                            'plan_name' => $plan->name,
                            'plan_id' => $plan->id,
                            'price' => $price,
                            'price_currency' => $this->currancy,
                            'txn_id' => '',
                            'payment_type' => __('STRIPE'),
                            'payment_status' => isset($data['status']) ? $data['status'] : 'succeeded',
                            'receipt' => 'free coupon',
                            'user_id' => $objUser->id,
                        ]
                    );

                }



                if(!empty($request->coupon))
                {
                     $coupons = Coupon::where('code', strtoupper($request->coupon))->where('is_active', '1')->first();

                    $userCoupon         = new UserCoupon();
                    $userCoupon->user   = $objUser->id;
                    $userCoupon->coupon = $coupons->id;
                    $userCoupon->order  = $orderID;
                    $userCoupon->save();

                    $usedCoupun = $coupons->used_coupon();
                    if($coupons->limit <= $usedCoupun)
                    {
                        $coupons->is_active = 0;
                        $coupons->save();
                    }
                }
            }
            catch(\Exception $e)
            {
                return redirect()->route('plans.index')->with('error', __($e->getMessage()));
            }
        }
        else
        {
            return redirect()->route('plans.index')->with('error', __('Plan is deleted.'));
        }
    }

    public function planGetStripePaymentStatus(Request $request)
    {
        $this->planpaymentSetting();
        $plan = Plan::find($request->plan_id);

        Session::forget('stripe_session');

        try
        {
            if($request->return_type == 'success')
            {
                $objUser                    = \Auth::user();

                $assignPlan = $objUser->assignPlan($request->plan_id,$request->frequency);
                $orderID = strtoupper(str_replace('.', '', uniqid('', true)));
                if($request->has('coupon_id') && $request->coupon_id != '')
                {
                    $coupons = Coupon::find($request->coupon_id);
                    if(!empty($coupons))
                    {
                        $userCoupon         = new UserCoupon();
                        $userCoupon->user   = $objUser->id;
                        $userCoupon->coupon = $coupons->id;
                        $userCoupon->order  = $orderID;
                        $userCoupon->save();
                        $usedCoupun = $coupons->used_coupon();
                        if($coupons->limit <= $usedCoupun)
                        {
                            $coupons->is_active = 0;
                            $coupons->save();
                        }
                    }
                }


                Order::create(
                    [
                        'order_id' => $orderID,
                        'name' => $objUser->name,
                        'card_number' => '',
                        'card_exp_month' => '',
                        'card_exp_year' => '',
                        'plan_name' => $plan->name,
                        'plan_id' => $plan->id,
                        'price' =>  $request->amount,
                        'price_currency' => $this->currancy,
                        'txn_id' => '',
                        'payment_type' => 'STRIPE',
                        'payment_status' => $request->return_type ,
                        'receipt' => '',
                        'user_id' => $objUser->id,
                    ]
                );

                if($assignPlan['is_success'])
                {

                    return redirect()->route('plans.index')->with('success', __('Plan successfully activated.'));
                }


                else
                {
                    return redirect()->route('plans.index')->with('error', __($assignPlan['error']));
                }
            }
            else
            {
                return redirect()->route('plans.index')->with('error', __('Your Payment has failed!'));
            }
        }
        catch(\Exception $exception)
        {
            return redirect()->route('plans.index')->with('error', __('Something went wrong.'));
        }
    }

    public function webhookStripe(Request $request)
    {
        $paymentSetting = Utility::getAdminPaymentSetting();

        /* Initiate Stripe */
        \Stripe\Stripe::setApiKey($paymentSetting['stripe_secret']);

        $payload    = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event      = null;

        try
        {
            $event = \Stripe\Webhook::constructEvent(
                $payload, $sig_header, $paymentSetting['stripe_webhook_secret']
            );

            if(!in_array(
                $event->type, [
                                'invoice.paid',
                                'checkout.session.completed',
                            ]
            ))
            {
                die();
            }

            $session = $event->data->object;

            $payment_id   = $session->id;
            $payer_id     = $session->customer;
            $payer_object = \Stripe\Customer::retrieve($payer_id);
            $payer_name   = $payer_object->name;
            $payer_email  = $payer_object->email;

            \Log::debug('event');
            \Log::debug($event);

            if($session->payment_intent)
            {
                try
                {
                    $stripe = new \Stripe\StripeClient(
                        $paymentSetting['stripe_secret']
                    );
                    $s      = $stripe->paymentIntents->retrieve(
                        $session->payment_intent, []
                    );
                    \Log::debug('payment_intent');
                    \Log::debug($s);
                }
                catch(\Exception $e)
                {
                    \Log::debug($e->getMessage());
                }
            }

            switch($event->type)
            {
                /* Handling recurring payments */ case 'invoice.paid':

                $payment_total = in_array(
                    env('CURRENCY'), [
                                       'MGA',
                                       'BIF',
                                       'CLP',
                                       'PYG',
                                       'DJF',
                                       'RWF',
                                       'GNF',
                                       'UGX',
                                       'JPY',
                                       'VND',
                                       'VUV',
                                       'XAF',
                                       'KMF',
                                       'KRW',
                                       'XOF',
                                       'XPF',
                                   ]
                ) ? $session->amount_paid : $session->amount_paid / 100;

                $payment_currency = strtoupper($session->currency);

                /* Process meta data */
                $metadata = $session->lines->data[0]->metadata;

                $user_id           = (int)$metadata->user_id;
                $package_id        = (int)$metadata->package_id;
                $payment_frequency = $metadata->payment_frequency;
                $code              = isset($metadata->code) ? $metadata->code : '';

                /* Vars */
                $payment_type            = $session->subscription ? 'recurring' : 'one-time';
                $payment_subscription_id = $payment_type == 'recurring' ? 'stripe###' . $session->subscription : '';

                break;

                /* Handling one time payments */ case 'checkout.session.completed':

                /* Exit when the webhook comes for recurring payments as the invoice.payment_succeeded event will handle it */ if($session->subscription)
            {
                die();
            }

                $payment_total    = in_array(
                    env('CURRENCY'), [
                                       'MGA',
                                       'BIF',
                                       'CLP',
                                       'PYG',
                                       'DJF',
                                       'RWF',
                                       'GNF',
                                       'UGX',
                                       'JPY',
                                       'VND',
                                       'VUV',
                                       'XAF',
                                       'KMF',
                                       'KRW',
                                       'XOF',
                                       'XPF',
                                   ]
                ) ? $session->amount_total : $session->amount_total / 100;
                $payment_currency = strtoupper($session->currency);

                /* Process meta data */
                $metadata = $session->metadata;

                $user_id           = (int)$metadata->user_id;
                $package_id        = (int)$metadata->package_id;
                $payment_frequency = $metadata->payment_frequency;
                $code              = isset($metadata->code) ? $metadata->code : '';

                /* Vars */
                $payment_type            = $session->subscription ? 'recurring' : 'one-time';
                $payment_subscription_id = $payment_type == 'recurring' ? 'stripe###' . $session->subscription : '';

                break;
            }

            $plan = Plan::find($package_id);
            if(!$plan)
            {
                http_response_code(400);
                die();
            }

            /* Make sure the account still exists */
            $user = User::find($user_id);

            if(!$user)
            {
                http_response_code(400);
                die();
            }

            /* Unsubscribe from the previous plan if needed */
            if(!empty($user->payment_subscription_id) && $user->payment_subscription_id != $payment_subscription_id)
            {
                try
                {
                    $user->cancel_subscription($user_id);
                }
                catch(\Exception $exception)
                {
                    \Log::debug($exception->getMessage());
                }
            }

            Order::create(
                [
                    'order_id' => $payment_id,
                    'subscription_id' => $session->subscription,
                    'payer_id' => $payer_id,
                    'name' => $payer_name,
                    'card_number' => '',
                    'card_exp_month' => '',
                    'card_exp_year' => '',
                    'plan_name' => $plan->name,
                    'plan_id' => $plan->id,
                    'price' => $payment_total,
                    'price_currency' => $payment_currency,
                    'txn_id' => '',
                    'payment_type' => 'STRIPE',
                    'payment_frequency' => $payment_frequency,
                    'payment_status' => '',
                    'receipt' => '',
                    'user_id' => $user->id,
                ]
            );

            if(!empty($code))
            {
                $coupons = Coupon::where('code', strtoupper($code))->where('is_active', '1')->first();

                $userCoupon         = new UserCoupon();
                $userCoupon->user   = $user->id;
                $userCoupon->coupon = $coupons->id;
                $userCoupon->order  = $payment_id;
                $userCoupon->save();
                $usedCoupun = $coupons->used_coupon();
                if($coupons->limit <= $usedCoupun)
                {
                    $coupons->is_active = 0;
                    $coupons->save();
                }
            }

            $user->payment_subscription_id = $payment_subscription_id;
            $user->save();

        }
        catch(\UnexpectedValueException $e)
        {

            \Log::debug($e->getMessage());

            // Invalid payload
            http_response_code(400);
            exit();

        }
        catch(\Stripe\Error\SignatureVerification $e)
        {

            \Log::debug($e->getMessage());
            // Invalid signature
            http_response_code(400);
            exit();

        }
    }

    public function planpaymentSetting()
    {

        $admin_payment_setting = Utility::getAdminPaymentSetting();

        $this->currancy_symbol = isset($admin_payment_setting['currency_symbol'])?$admin_payment_setting['currency_symbol']:'';
        $this->currancy = isset($admin_payment_setting['currency'])?$admin_payment_setting['currency']:'';

        $this->stripe_secret = isset($admin_payment_setting['stripe_secret'])?$admin_payment_setting['stripe_secret']:'';
        $this->stripe_key = isset($admin_payment_setting['stripe_key'])?$admin_payment_setting['stripe_key']:'';
        $this->stripe_webhook_secret = isset($admin_payment_setting['stripe_webhook_secret'])?$admin_payment_setting['stripe_webhook_secret']:'';
    }
}
